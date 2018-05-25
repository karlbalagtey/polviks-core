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
 * Customers
 */
Route::resource('customers', 'Customer\CustomerController');

/**
 * Agents
 */
Route::resource('agents', 'Agent\AgentController');

/**
 * Products
 */
Route::resource('products', 'Product\ProductController');

/**
 * Service
 */
Route::resource('services', 'Service\ServiceController');