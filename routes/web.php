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
