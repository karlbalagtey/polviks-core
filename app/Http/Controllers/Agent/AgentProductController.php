<?php

namespace App\Http\Controllers\Agent;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Contracts\AgentRepository;
use App\Contracts\ProductRepository;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AgentProductRequest;

class AgentProductController extends ApiController
{
    protected $user;
    protected $product;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $user User repository with Eloquent
     */
    public function __construct(AgentRepository $user, ProductRepository $product)
    {
        $this->user = $user;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $products = $this->user->getProducts($id);

        return $this->showAll($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgentProductRequest $request, $id)
    {
        $product = $this->product->store($request, $id);
    
        return $this->showOne($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($agent_id, $product_id)
    {
        $product = $this->product->getAgentProduct($agent_id, $product_id);
    
        return $this->showOne($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($agent_id, $product_id, Request $request)
    {
        Validator::make($request->all(), [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
        ])->validate();

        // $this->checkAgent($agent_id, $product_id);

        $product = $this->product->update($agent_id, $product_id, $request);

        return $this->showOne($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($agent_id, $product_id)
    {
        return $this->product->destroy($agent_id, $product_id);
    }
}
