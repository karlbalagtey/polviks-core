<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\ApiResponser;
use App\Contracts\ProductRepository;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductEloquentRepository implements ProductRepository
{
    use ApiResponser;

	protected $product;

    /**
     * Constructor injects Agent Model
     * @param User       $product  User model
     * @param Curriculum $class Curriculum
     */
	public function __construct(Product $product)
	{
		$this->product = $product;
	}

    /**
     * Returns all products
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
	{
		return $this->product->all();
	}

    /**
     * Returns one product
     * @param $id
     * @return mixed
     */
    public function show($product_id)
	{
        return $this->product->findOrfail($product_id);
	}

    /**
     * Returns all products for this agent
     * @param $id
     * @return mixed
     */
    public function getAgentProduct($agent_id, $product_id)
    {
        $product = $this->product->findOrfail($product_id);

        $this->checkAgent($agent_id, $product);

        return $product;
    }

    /**
     * Returns all transactions for this product
     * @param $id
     * @return mixed
     */
    public function getTransactions($product_id)
    {
        $product = $this->product->findOrfail($product_id);

        return $product->transactions;
    }

    /**
     * Returns all customers for this product
     * @param $id
     * @return mixed
     */
    public function getCustomers($product_id)
    {
        $product = $this->product->findOrfail($product_id);

        return $product->transactions()
            ->with('customer')
            ->get()
            ->pluck('customer')
            ->unique('id')
            ->values();
    }

    /**
     * Adds category for this product
     * @param $id
     * @return mixed
     */
    public function addCategory($product_id, $category_id)
    {
        $product = $this->product->findOrfail($product_id);

        $product->categories()->syncWithoutDetaching([$category_id]);

        return $product->categories;
    }

    /**
     * Adds category for this product
     * @param $id
     * @return mixed
     */
    public function removeCategory($product_id, $category_id)
    {
        $product = $this->product->findOrfail($product_id);

        if (!$product->categories()->find($category_id)) {
            return $this->errorResponse('The specified category is not a category of this product', 404);
        }

        $product->categories()->detach($category_id);

        return $product->categories;
    }

    /**
     * Returns all categories for this product
     * @param $id
     * @return mixed
     */
    public function getCategories($product_id)
    {
        $product = $this->product->findOrfail($product_id);

        return $product->categories;
    }

    /**
     * Return product via slug
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->product->where('slug', $slug)->first();
    }

    /**
     * Creates new product and returns $product
     * @param $data
     * @return mixed
     */
    public function store($request, $id)
    {
        $data = $request->all();

        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['agent_id'] = $id;

        $product = Product::create($data);

        return $product;
    }

    /**
     * Updates user and returns $product
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($agent_id, $product_id, $request)
	{
        $product = $this->getAgentProduct($agent_id, $product_id);

        $product->fill($request->only([
        	'name',
        	'description',
        	'quantity',
        ]));

        if ($request->has('status')) {
            $product->status = $request->status;
            
            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return $this->errorResponse('An active product must have at least one category', 409);
            }
        }

        if ($product->isClean()) {
            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $product->save();

        return $product;
    }

    /**
     * Deletes product
     * @param $id
     * @return int
     */
    public function destroy($agent_id, $product_id)
	{
        $product = $this->getAgentProduct($agent_id, $product_id);

        $product->delete();

		return $product;
	}

    /**
     * Checks agent if its correct
     * @param  [type] $request [description]
     * @param  [type] $id      [description]
     * @return [type]          [description]
     */
    protected function checkAgent($agent_id, $product)
    {   
        if ($agent_id != $product->agent_id) {
            throw new HttpException(422, 'The specified agent is not the actual seller of this product');
        }
    }
}