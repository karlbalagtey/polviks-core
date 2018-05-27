<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, CustomerRepository $customer)
    {
        $products = $customer->getProducts($id);

        return $this->showAll($products);
    }
}
