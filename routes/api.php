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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('login', ['as' => 'login', 'uses' => 'Api\UserController@login']);
Route::post('register', 'Api\UserController@register');

Route::group(['prefix' => 'api', 'middleware' => 'auth:api', 'as' => 'api.'], function(){
    Route::post('details', 'Api\UserController@details');

    Route::group(['prefix' => 'client', 'middleware' => 'oauth.checkrole:client', 'as' => 'client.'], function(){
        Route::get('orders', ['as' => 'orders.index', 'uses' => 'Api\ClientCheckoutController@index']);
        Route::get('orders/show/{id}', ['as' => 'orders.show', 'uses' => 'Api\ClientCheckoutController@show']);
        Route::post('orders/store',['as' => 'orders.store', 'uses' => 'Api\ClientCheckoutController@store']);
        Route::post('orders/update/{id}',['as' => 'orders.update', 'uses' => 'Api\ClientCheckoutController@update']);
    });

    Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.checkrole:deliveryman', 'as' => 'deliveryman.'], function(){
        Route::get('orders', ['as' => 'deliveryman.index', 'uses' => 'Api\DeliverymanCheckoutController@index']);
        Route::get('orders/show/{id}', ['as' => 'deliveryman.show', 'uses' => 'Api\DeliverymanCheckoutController@show']);
        Route::patch('orders/update-status/{id}', ['as' => 'deliveryman.update_status', 'uses' => 'Api\DeliverymanCheckoutController@updateStatus']);
    });
});