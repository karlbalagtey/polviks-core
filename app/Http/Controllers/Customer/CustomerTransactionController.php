<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerTransactionController extends ApiController
{
    protected $customer;

    /**
     * Constructor injected with Service Transaction Repository
     * @param ServiceTransactionRepository $transaction
     */
    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function service($id)
    {
        $transactions = $this->customer->getServiceTransactions($id);

        return $this->showAll($transactions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product($id)
    {
        $transactions = $this->customer->getProductTransactions($id);

        return $this->showAll($transactions);
    }
}
