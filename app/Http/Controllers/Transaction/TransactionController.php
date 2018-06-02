<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Contracts\ProductTransactionRepository;
use App\Contracts\ServiceTransactionRepository;

class TransactionController extends ApiController
{
    protected $productTransaction;
    protected $serviceTransaction;

    public function __construct(
        ProductTransactionRepository $productTransaction, 
        ServiceTransactionRepository $serviceTransaction
    )
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only(['productTransactions', 'serviceTransactions']);

        $this->productTransaction = $productTransaction;
        $this->serviceTransaction = $serviceTransaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productTransactions()
    {
        $transactions = $this->productTransaction->getAll();

        return $this->showAll($transactions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function oneProductTransaction($product_id)
    {
        $transaction = $this->productTransaction->getOne($product_id);

        return $this->showOne($transaction);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceTransactions()
    {
        $transactions = $this->serviceTransaction->getAll();

        return $this->showAll($transactions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function oneServiceTransaction($service_id)
    {
        $transaction = $this->serviceTransaction->getOne($service_id);

        return $this->showOne($transaction);
    }
}
