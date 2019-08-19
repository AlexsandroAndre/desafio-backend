<?php

namespace App\Http\Controllers\Api;

use App\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(Product $product)
	{
		$this->product = $product;
	}

    public function index()
    {
    	$products = $this->product->all();
        return response()->json($products);
    }

    public function show($product_id)
    {
		$product = $this->product::where('product_id', '=', $product_id)->get();
		if($product->isEmpty())
    	{
    		return response()->json(['data' => ['message' => 'Produto não encontrado!']], 404);
    	}
        return response()->json($product);
    }

    public function store(Request $request)
    {
		try
		{
    		$data = $request->all();
			$this->product->create($data);
	    	return response()->json(['message' => 'Produto criado com sucesso.'], 201);
		} 
		catch (\Exception $e)
		{
            if(config('app.debug'))
            {
    			return response()->json($e->getMessage(), 400);
    		}
			return response()->json('Houve um erro ao criar o produto.', 400);
		}
	}
}
