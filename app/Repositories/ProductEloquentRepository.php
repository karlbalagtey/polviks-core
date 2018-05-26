<?php

namespace App\Repositories;

use App\Models\Product;
use App\Contracts\ProductRepository;

class ProductEloquentRepository implements ProductRepository
{

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
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
	{
		return $this->product->all();
	}

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
	{
		return $this->product->findOrfail($id);
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
     * Creates new user and returns $product
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $product = $this->product::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // $product->curriculum()->attach($data['curriculum']);

        return $product;
    }

    /**
     * Updates user and returns $product
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
	{
        $product = $this->show($id);

        $product->update([
        	'username' => $request->productname,
        	'name' => $request->name,
        	'email' => $request->email
        ]);

        if($request->password != ''){
            $product->password = bcrypt($request->password);
            $product->save();
        }

        return $product;
    }

    /**
     * Deletes product
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
        $product = $this->show($id);
        $product->delete();

		return $product;
	}
}