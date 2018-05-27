<?php

namespace App\Http\Controllers\Customer;

use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, CustomerRepository $customer)
    {
        $transactions = $customer->getTransactions($id, $type);

        return $this->showAll($transactions);
    }
}
