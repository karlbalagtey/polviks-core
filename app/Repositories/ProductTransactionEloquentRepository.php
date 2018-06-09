<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Customer;
use App\Traits\ApiResponser;
use App\Models\ProductTransaction;
use Illuminate\Support\Facades\DB;
use App\Contracts\ProductTransactionRepository;

class ProductTransactionEloquentRepository implements ProductTransactionRepository
{

    use ApiResponser;

	protected $transaction;
    protected $product;
    protected $customer;

    /**
     * Constructor inject ProductTransaction model
     * @param ProductTransaction $transaction
     */
	public function __construct(ProductTransaction $transaction, Product $product, Customer $customer)
	{
		$this->transaction = $transaction;
        $this->product = $product;
        $this->customer = $customer;
	}


    /**
     * Returns all product transactions
     * @return [type] [description]
     */
    public function getAll()
    {
        return $this->transaction->all();
    }

    /**
     * Returns one transaction
     * @param $id
     * @return mixed
     */
    public function getOne($transaction_id)
    {
        return $this->transaction->findOrfail($transaction_id);
    }

    /**
     * Returns all categories
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories($id)
    {
        $transaction = $this->transaction->findOrfail($id);
        
        return $transaction->product->categories;
    }

    /**
     * Creates new user and returns $transaction
     * @param $data
     * @return mixed
     */
    public function addCustomerProduct($product_id, $customer_id, $request)
    {
        $customer = $this->customer->findOrfail($customer_id);
        $product = $this->product->findOrfail($product_id);

        if ($customer_id == $product->customer_id) {
            return $this->errorResponse('The customer must be different from the agent', 409);
        }

        if (!$customer->isVerified()) {
            return $this->errorResponse('The customer must be a verified user', 409);
        }

        if (!$product->agent->isVerified()) {
            return $this->errorResponse('The agent must be a verified user', 409);
        }

        if (!$product->isAvailable()) {
            return $this->errorResponse('The product is not available', 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('The product does not have enough units for this transaction', 409);
        }

        return DB::transaction(function() use ($request, $product, $customer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = $this->transaction::create([
                'quantity' => $request->quantity,
                'customer_id' => $customer->id,
                'product_id' => $product->id,
            ]);

            return $transaction;
        });
    }

    /**
     * Returns customer
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAgent($id)
    {
        $transaction = $this->transaction->findOrfail($id);
        
        return $transaction->service->agent;
    }
}