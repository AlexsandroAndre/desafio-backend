<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\Api\ApiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function __construct(History $history)
	{
		$this->history = $history;
    }
    
    public function index()
    {
        $histories = $this->history->all();

        $histories->each(function ($history, $key) {
            $history->card_number = '**** **** **** '.substr($history->card_number, 11, 14);
        });
        return response()->json($histories);
    }

    public function show($client_id)
    {
    	$histories = $this->history::where('client_id', '=', $client_id)->get();
    	if($histories->isEmpty())
    	{
    		return response()->json(['data' => ['message' => 'O cliente não possui histórico de compras!']], 404);
        }
        $histories->each(function ($history, $key) {
            $history->card_number = '**** **** **** '.substr($history->card_number, 12, 14);
        });
        return response()->json($histories);
    }

    public function store(Request $request)
    {
        $histories = collect($request)->only('client_id', 'order_id')->toArray();
        $histories['value'] = $request->get("value_to_pay");
        $histories['order_id'] = $request->get("cart_id");
        $histories['card_number'] = $request->credit_card['number'];
        $histories['date'] = today();
        $this->history->create($histories);
    }
}
