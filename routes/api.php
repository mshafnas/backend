<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::apiResources(['product' => 'API\ProductController']);
Route::get('product', 'API\ProductController@index');
Route::get('product/{id}', 'API\ProductController@show');
Route::post('product', 'API\ProductController@store');
Route::put('product/{id}', 'API\ProductController@update');
Route::delete('product/{id}', 'API\ProductController@destroy');