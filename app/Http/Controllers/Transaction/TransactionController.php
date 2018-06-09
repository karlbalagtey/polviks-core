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

        $this->middleware('can:view,App\Models\ProductTransaction')->only('showProductTransaction');
        $this->middleware('can:view,App\Models\ServiceTransaction')->only('showServiceTransaction');

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
        // $this->forAdminOnly();

        $transactions = $this->productTransaction->getAll();

        return $this->showAll($transactions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showProductTransaction($productTransaction)
    {
        $transaction = $this->productTransaction->getOne($productTransaction);

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
    public function showServiceTransaction($serviceTransaction)
    {
        $transaction = $this->serviceTransaction->getOne($serviceTransaction);

        return $this->showOne($transaction);
    }
}
