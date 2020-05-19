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

Route::get('items', 'Items@getItems');
Route::post('items/{id}/images', 'Items@saveImage');
Route::get('items/{id}/images', 'Items@getImages');
Route::get('items/{id}', 'Items@getItem');
Route::post('items', 'Items@saveItem');
Route::put('items/{id}', 'Items@updateItem');
Route::delete('items/{id}', 'Items@deleteItem');
