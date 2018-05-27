<?php

namespace App\Http\Controllers\Product;

use App\Contracts\ProductRepository;
use App\Http\Controllers\ApiController;

class ProductCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id, ProductRepository $product)
    {
        $customers = $product->getCustomers($product_id);

        return $this->showAll($customers);
    }
}
