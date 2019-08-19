<?php

namespace App\Http\Controllers\Api;

use App\Transaction;
use App\CreditCard;
use App\Api\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\CreditCardController;
use App\Http\Controllers\Api\HistoryController;

class TransactionController extends Controller
{
    public function __construct(Transaction $transaction, CreditCardController $creditCardController, 
        HistoryController $historyController)
	{
		$this->transaction = $transaction;
		$this->creditCardController = $creditCardController;
		$this->historyController = $historyController;
    }
    
    public function index()
    {
		$data = $this->transaction->all();
		$data->each(function ($transaction, $key){    
            $transaction->card_number = '**** **** **** '.substr($transaction->card_number, 11, 4);;
		});
        return response()->json($data);
    }

    public function show($client_id)
    {
    	$transaction = $this->transaction::where('client_id', '=', $client_id)->get();
    	if($transaction->isEmpty())
    	{
    		return response()->json(['data' => ['message' => 'Não foi encontrada a transação!']], 404);
    	}
		$transaction->each(function ($obj, $key){    
            $obj->card_number = '**** **** **** '.substr($obj->card_number, 11, 4);;
		});
        return response()->json($transaction);
    }

    public function store(Request $request)
    {
		try
		{
			$data = collect($request->get("credit_card"))->only('client_id', 'cart_id', 'client_name', 'value_to_pay')
				->toArray();
				
			$data['card_number'] = $request->credit_card['number'];
			$this->transaction->create($data);
			$this->creditCardController->store($request);
			$this->historyController->store($request);
	    	return response()->json(['msg' => 'Parabéns pela sua compra, obrigado.'], 201);
		}
		catch (\Exception $e)
		{
    		if(config('app.debug'))
    		{
    			return response()->json(ApiError::errorMessage($e->getMessage(), 400));
    		}
    		return response()->json(ApiError::errorMessage('Desculpe não podemos realizar sua compra.', 400));
    	}
	}
}
