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
Route::resource('customers', 'Customer\CustomerController', ['except' => ['create', 'edit']]);
Route::get('customers/{id}/{type}/transactions', 'Customer\CustomerTransactionController@index');
Route::get('customers/{id}/products/agents', 'Customer\CustomerAgentController@product');
Route::get('customers/{id}/services/agents', 'Customer\CustomerAgentController@service');
Route::get('customers/{id}/products', 'Customer\CustomerProductController@index');
Route::get('customers/{id}/services', 'Customer\CustomerServiceController@index');
Route::get('customers/{id}/services/categories', 'Customer\CustomerCategoryController@service');
Route::get('customers/{id}/products/categories', 'Customer\CustomerCategoryController@product');

/**
 * Agents
 */
Route::resource('agents', 'Agent\AgentController', ['except' => ['create', 'edit']]);

/**
 * Categories
 */
Route::resource('categories', 'Category\CategoryController');
Route::get('categories/{id}/{type}', 'Category\CategoryItemController@index');
Route::get('categories/{id}/{type}/agents', 'Category\CategoryAgentController@index');
Route::get('categories/{id}/{type}/customers', 'Category\CategoryCustomerController@index');
Route::get('categories/{id}/{type}/transactions', 'Category\CategoryTransactionController@index');

/**
 * Products
 */
Route::resource('products', 'Product\ProductController', ['except' => ['create', 'edit']]);

/**
 * Service
 */
Route::resource('services', 'Service\ServiceController', ['only' => ['index', 'show']]);
Route::resource('services-transactions.categories', 'Service\ServiceTransactionCategoryController', ['only' => ['index']]);
Route::resource('services-transactions.agents', 'Service\ServiceTransactionAgentController', ['only' => ['index']]);