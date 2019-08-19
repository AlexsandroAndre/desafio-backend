<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * CREDPAGO DESAFIO API
 */
Route::namespace('Api')->name('api.')->group(function(){
    Route::prefix('/v1')->group(function(){
        /**
         * BUY
         */
        Route::prefix('/buy')->group(function(){
			Route::post('/', 'TransactionController@store')->name('buy');
		});
        /**
         * CARDS
         */
        Route::prefix('/cards')->group(function(){
			Route::get('/', 'CreditCardController@index')->name('cards');
			Route::get('/{card_number}', 'CreditCardController@show')->name('single_card');
        });
        /**
         * CARTS   
         */
        Route::prefix('/add_to_cart')->group(function(){
			Route::post('/', 'CartController@store')->name('add_to_cart');
        });
        /**
         * HISTORY
         */
        Route::prefix('/history')->group(function(){
			Route::get('/', 'HistoryController@index')->name('histories');
			Route::get('/{client_id}', 'HistoryController@show')->name('single_history');
        });
        /**
         * PRODUCTS
         */
        Route::prefix('/product')->group(function(){
			Route::get('/', 'ProductController@index')->name('products');
            Route::get('/{product_id}', 'ProductController@show')->name('single_product');
            Route::post('/', 'ProductController@store')->name('store_products');
        });
    });
});
/**
 * CREDPAGO DESAFIO API
 */