<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerAgentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($id, CustomerRepository $customer)
    {
        $agents = $customer->getServiceAgents($id);

        return $this->showAll($agents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($id, CustomerRepository $customer)
    {
        $agents = $customer->getProductAgents($id);

        return $this->showAll($agents);
    }
}
