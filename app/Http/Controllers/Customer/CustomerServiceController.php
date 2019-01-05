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
        $this->middleware('auth:admin-api,customer-api');
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,App\Models\Customer')->only('index');
    }
    
    /**
     * Display a listing of services for this customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, CustomerRepository $customer)
    {
        $services = $customer->getServices($id);

        return $this->showAll($services);
    }
}
