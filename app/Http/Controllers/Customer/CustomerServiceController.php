<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerServiceController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, CustomerRepository $customer)
    {
        $services = $customer->getServices($id);

        return $this->showAll($services);
    }
}
