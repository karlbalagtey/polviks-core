<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Contracts\ProductRepository;
use App\Http\Controllers\ApiController;

class ProductController extends ApiController
{
    protected $product;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $product User repository with Eloquent
     */
    public function __construct(ProductRepository $product)
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->getAll();

        return $this->showAll($products);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->show($id);

        return $this->showOne($product);
    }
}
