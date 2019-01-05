<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerTransactionController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:admin-api,customer-api');
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,App\Models\Customer')->only('index');
    }
    
    /**
     * Display all transaction listing of this customer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, CustomerRepository $customer)
    {
        $transactions = $customer->getTransactions($id, $type);

        return $this->showAll($transactions);
    }
}
