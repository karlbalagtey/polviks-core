<?php

namespace App\Http\Controllers\Product;

use App\Contracts\ProductRepository;
use App\Http\Controllers\ApiController;

class ProductTransactionController extends ApiController
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
    public function index($product_id, ProductRepository $product)
    {
        $transactions = $product->getTransactions($product_id);

        return $this->showAll($transactions);
    }
}