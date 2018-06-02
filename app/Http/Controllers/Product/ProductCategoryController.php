<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Contracts\ProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ProductCategoryController extends ApiController
{
    protected $product;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $product User repository with Eloquent
     */
    public function __construct(ProductRepository $product)
    {
        $this->middleware('client.credentials')->only(['index']);
        $this->middleware('auth:api')->except(['index']);
        $this->middleware('scope:manage-products')->except(['index']);

        $this->product = $product;
    }    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $categories = $this->product->getCategories($product_id);

        return $this->showAll($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($product_id, $category_id)
    {
        $categories = $this->product->addCategory($product_id, $category_id);

        return $this->showAll($categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $category_id)
    {
        $categories = $this->product->removeCategory($product_id, $category_id);

        return $this->showAll($categories);
    }
}
