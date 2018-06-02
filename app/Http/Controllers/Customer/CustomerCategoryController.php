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
        parent::__construct();
        $this->middleware('scope:read-general')->only('index');

        $this->customer = $customer;
    }

    public function index($customer_id)
    {
        $categories = $this->customer->getCategories($customer_id);

        return $this->showAll($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($customer_id)
    {
        $categories = $this->customer->getServiceCategories($customer_id);

        return $this->showAll($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($customer_id)
    {
        $categories = $this->customer->getProductCategories($customer_id);

        return $this->showAll($categories);
    }
}
