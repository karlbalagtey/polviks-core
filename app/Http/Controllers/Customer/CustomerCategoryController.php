<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;
use App\Transformers\CustomerTransformer;

class CustomerCategoryController extends ApiController
{
    protected $customer;

    public function __construct(CustomerRepository $customer)
    {
        $this->middleware('auth:admin-api,customer-api');
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,App\Models\Customer')->only('index');

        $this->customer = $customer;
    }

    /**
     * Display a listing of all the categories this customer 
     * had transactions from.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($customer_id)
    {
        $categories = $this->customer->getCategories($customer_id);

        return $this->showAll($categories);
    }

    /**
     * Display a listing of all the categories in the services where
     * customer had transactions
     *
     * @return \Illuminate\Http\Response
     */
    public function service($customer_id)
    {
        $categories = $this->customer->getServiceCategories($customer_id);

        return $this->showAll($categories);
    }

    /**
     * Display a listing of all the categories in the products where
     * customer had transactions in
     *
     * @return \Illuminate\Http\Response
     */
    public function product($customer_id)
    {
        $categories = $this->customer->getProductCategories($customer_id);

        return $this->showAll($categories);
    }
}
