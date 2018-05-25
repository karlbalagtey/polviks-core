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
 * Admin users
 */
Route::resource('users', 'User\UserController', ['except' => ['create', 'edit']]);

/**
 * Customers
 */
Route::resource('customers', 'Customer\CustomerController', ['only' => ['index', 'show']]);

/**
 * Agents
 */
Route::resource('agents', 'Agent\AgentController', ['only' => ['index', 'show']]);

/**
 * Categories
 */
Route::resource('categories', 'Service\ServiceController', ['except' => ['create', 'edit']]);

/**
 * Products
 */
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);

/**
 * Service
 */
Route::resource('services', 'Service\ServiceController', ['only' => ['index', 'show']]);