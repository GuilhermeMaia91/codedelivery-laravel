<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/categories', ['as' => 'admin.categories.index', 'uses' => 'CategoriesController@index']);
Route::get('admin/categories/create',['as' => 'admin.categories.create', 'uses' => 'CategoriesController@create']);
Route::post('admin/categories/store',['as' => 'admin.categories.store', 'uses' => 'CategoriesController@store']);
Route::get('admin/categories/edit/{id}',['as' => 'admin.categories.edit', 'uses' => 'CategoriesController@edit']);
Route::post('admin/categories/update/{id}',['as' => 'admin.categories.update', 'uses' => 'CategoriesController@update']);

Route::get('admin/products', ['as' => 'admin.products.index', 'uses' => 'ProductsController@index']);
Route::get('admin/products/create',['as' => 'admin.products.create', 'uses' => 'ProductsController@create']);
Route::post('admin/products/store',['as' => 'admin.products.store', 'uses' => 'ProductsController@store']);
Route::get('admin/products/edit/{id}',['as' => 'admin.products.edit', 'uses' => 'ProductsController@edit']);
Route::post('admin/products/update/{id}',['as' => 'admin.products.update', 'uses' => 'ProductsController@update']);