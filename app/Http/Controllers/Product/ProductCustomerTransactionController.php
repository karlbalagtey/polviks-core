<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ProductTransactionRepository;
use App\Transformers\ProductTransactionTransformer;

class ProductCustomerTransactionController extends ApiController
{
    protected $transaction;

    /**
     * Constructor injects ProductTransaction Repository
     * @param ProductTransactionRepository $transaction
     */
    public function __construct(ProductTransactionRepository $transaction)
    {
        parent::__construct();
        $this->middleware('transform.input:' . ProductTransactionTransformer::class)->only(['store']);
        $this->middleware('scope:purchase-product')->only(['store']);
        $this->middleware('can:purchase,customer')->only('store');

        $this->transaction = $transaction;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($product_id, $customer_id, Request $request)
    {
        Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1'
        ])->validate();

        $transaction = $this->transaction->addCustomerProduct($product_id, $customer_id, $request);

        return $this->showOne($transaction, 201);
    }
}
