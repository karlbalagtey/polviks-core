<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerCategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($id, CustomerRepository $customer)
    {
        $categories = $customer->getServiceCategories($id);

        return $this->showAll($categories);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($id, CustomerRepository $customer)
    {
        $categories = $customer->getProductCategories($id);

        return $this->showAll($categories);
    }
}