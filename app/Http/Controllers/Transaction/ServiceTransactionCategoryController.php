<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Contracts\ServiceTransactionRepository;

class ServiceTransactionCategoryController extends ApiController
{
    protected $transaction;

    /**
     * Constructor injected with Service Transaction Repository
     * @param ServiceTransactionRepository $transaction
     */
    public function __construct(ServiceTransactionRepository $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($request)
    {
        $categories = $this->transaction->getCategories($request);

        return $this->showAll($categories);
    }
}
