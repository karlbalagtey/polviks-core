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
Route::name('customers.type.transactions.index')->get('customers/{id}/{type}/transactions', 'Customer\CustomerTransactionController@index');
Route::name('customers.products.agents.index')->get('customers/{id}/products/agents', 'Customer\CustomerAgentController@product');
Route::name('customers.services.agents.index')->get('customers/{id}/services/agents', 'Customer\CustomerAgentController@service');
Route::name('customers.products.index')->get('customers/{id}/products', 'Customer\CustomerProductController@index');
Route::name('customers.services.index')->get('customers/{id}/services', 'Customer\CustomerServiceController@index');
Route::name('customers.services.categories')->get('customers/{id}/services/categories', 'Customer\CustomerCategoryController@service');
Route::name('customers.products.categories')->get('customers/{id}/products/categories', 'Customer\CustomerCategoryController@product');

/**
 * Categories
 */
Route::resource('categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('categories.customers', 'Category\CategoryCustomerController', ['only' => ['index', 'show']]);
Route::resource('categories.agents', 'Category\CategoryAgentController', ['only' => ['index', 'show']]);
Route::resource('categories.products', 'Category\CategoryProductController', ['only' => ['index']]);
Route::resource('categories.services', 'Category\CategoryServiceController', ['only' => ['index']]);
Route::resource('categories.items', 'Category\CategoryItemController', ['only' => ['index']]);
Route::resource('categories.transactions', 'Category\CategoryTransactionController', ['only' => ['index', 'show']]);

Route::name('categories.transactions.show')->get('categories/{id}/{type}/transactions', 'Category\CategoryTransactionController@show');
Route::name('categories.agents.show')->get('categories/{id}/{type}/agents', 'Category\CategoryAgentController@show');
Route::name('categories.customers.show')->get('categories/{id}/{type}/customers', 'Category\CategoryCustomerController@show');

/**
 * Services (Agency)
 */
Route::resource('services', 'Service\ServiceController', ['only' => ['index', 'show']]);
Route::resource('services.customers', 'Service\ServiceCustomerController', ['only' => ['index']]);
Route::resource('services.categories', 'Service\ServiceCategoryController', ['only' => ['index', 'update', 'destroy']]);
Route::resource('services.transactions', 'Service\ServiceTransactionController', ['only' => ['index']]);
Route::resource('services.customers.transactions', 'Service\ServiceCustomerTransactionController', ['only' => ['store']]);

/**
 * Products (Marketplace)
 */
Route::resource('products', 'Product\ProductController', ['only' => ['index', 'show']]);
Route::resource('products.customers', 'Product\ProductCustomerController', ['only' => ['index']]);
Route::resource('products.categories', 'Product\ProductCategoryController', ['only' => ['index', 'update', 'destroy']]);
Route::resource('products.transactions', 'Product\ProductTransactionController', ['only' => ['index']]);
Route::resource('products.customers.transactions', 'Product\ProductCustomerTransactionController', ['only' => ['store']]);

/**
 * Agents
 */
Route::resource('agents', 'Agent\AgentController', ['except' => ['create', 'edit']]);
Route::name('agents.customers')->get('agents/{id}/{type}/customers', 'Agent\AgentCustomerController@index');
Route::resource('agents.products', 'Agent\AgentProductController', ['except' => ['create', 'edit']]);
Route::resource('agents.services', 'Agent\AgentServiceController', ['except' => ['create', 'edit']]);
Route::name('agents.categories')->get('agents/{id}/{type}/categories', 'Agent\AgentCategoryController@index');
Route::name('agents.transactions')->get('agents/{id}/{type}/transactions', 'Agent\AgentTransactionController@index');

/**
 * Transactions
 */
Route::resource('services-transactions.categories', 'Transaction\ServiceTransactionCategoryController', ['only' => ['index']]);
Route::resource('products-transactions.categories', 'Transaction\ProductTransactionCategoryController', ['only' => ['index']]);
Route::resource('services-transactions.agents', 'Transaction\ServiceTransactionAgentController', ['only' => ['index']]);
Route::resource('products-transactions.agents', 'Transaction\ProductTransactionAgentController', ['only' => ['index']]);

Route::name('services-transactions.index')->get('services-transactions', 'Transaction\TransactionController@serviceTransactions');
Route::name('services-transactions.show')->get('services-transactions/{id}', 'Transaction\TransactionController@oneServiceTransaction');
Route::name('products-transactions.index')->get('products-transactions', 'Transaction\TransactionController@productTransactions');
Route::name('products-transactions.show')->get('products-transactions/{id}', 'Transaction\TransactionController@oneProductTransaction');

/**
 * Users
 */
Route::name('verify-customer')->get('customers/verify/{token}', 'Customer\CustomerController@verify');
Route::name('verify-agent')->get('agents/verify/{token}', 'Agent\AgentController@verify');
Route::name('verify-user')->get('users/verify/{token}', 'User\UserController@verify');
Route::name('resend-customer')->get('customers/{customer}/resend', 'Customer\CustomerController@resend');
Route::name('resend-agent')->get('agents/{agent}/resend', 'Agent\AgentController@resend');
Route::name('resend-user')->get('users/{user}/resend', 'User\UserController@resend');