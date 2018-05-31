<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ServiceTransactionRepository;

class ServiceCustomerTransactionController extends ApiController
{
    protected $transaction;

    /**
     * Constructor injects ProductTransaction Repository
     * @param ProductTransactionRepository $transaction
     */
    public function __construct(ServiceTransactionRepository $transaction)
    {
        parent::__construct();
        $this->middleware('transform.input:' . TransactionTransformer::class)->only(['store']);
        $this->transaction = $transaction;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($service_id, $customer_id, Request $request)
    {
        Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ])->validate();

        $transaction = $this->transaction->addCustomerService($service_id, $customer_id, $request);

        return $this->showOne($transaction, 201);
    }
}
