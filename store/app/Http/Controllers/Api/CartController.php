<?php

namespace App\Http\Controllers\Api;

use App\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function __construct(Cart $cart)
	{
		$this->cart = $cart;
    }
    
    public function index()
    {
        $carts = $this->cart->all();
    	return response()->json($carts);
    }

    public function show($cart_id)
    {
    	$cart = $this->cart::where('cart_id', '=', $cart_id)->get();
    	if($cart->isEmpty())
    	{
    		return response()->json(['data' => ['message' => 'Carrinho não encontrado!']], 404);
		}
		return response()->json($cart);
    }

    public function store(Request $request)
    {
		try
		{
    		$cartData = $request->all();
	    	$this->cart->create($cartData);
	    	return response()->json(['message' => 'Carrinho criado com sucesso.'], 201);
		}
		catch (\Exception $e)
		{
    		if(config('app.debug'))
    		{
    			return response()->json($e->getMessage(), 400);
    		}
    		return response()->json('Houve um erro ao criar o carrinho.', 400);
    	}
	}
}
