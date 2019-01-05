<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerAgentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:admin-api,customer-api');
    }

    /**
     * Display a listing of all the service agents (Seller of service) of this customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($id, CustomerRepository $customer)
    {
        $agents = $customer->getServiceAgents($id);

        return $this->showAll($agents);
    }

    /**
     * Display a listing of all the product agents (Seller of products) of this customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($id, CustomerRepository $customer)
    {
        $agents = $customer->getProductAgents($id);

        return $this->showAll($agents);
    }
}
