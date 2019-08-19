<?php

namespace App\Http\Controllers\Api;

use App\CreditCard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditCardController extends Controller
{
    public function __construct(CreditCard $creditCard)
	{
		$this->creditCard = $creditCard;
    }

    public function index()
    {
        $cards = $this->creditCard->all();
        $cards->each(function ($creditCard, $key)
        {
            $creditCard->card_number = '**** **** **** '.substr($creditCard->card_number, 12, 4);
        });
        return response()->json($cards);
    }

    public function show($card_number)
    {
    	$card = $this->creditCard::where('card_number', '=', $card_number)->get();
    	if($creditCard->isEmpty())
    	{
            return response()->json(['data' => ['message' => 'Não encontramos seu cartão de crédito!']], 404);
    	}
        return response()->json($card);
    }

    public function store(Request $request)
    {   
        $data = $request->all();
        $data['card_number'] = $request->credit_card['number'];
        $data['cvv'] = $request->credit_card['cvv'];
        $this->creditCard->create($data);
    }
}
