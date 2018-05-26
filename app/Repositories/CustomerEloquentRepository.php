<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Traits\ApiResponser;
use App\Contracts\CustomerRepository;

class CustomerEloquentRepository implements CustomerRepository
{

    use ApiResponser;

    protected $user;

    /**
     * Constructor injects Admin Users
     * @param User       $user  User model
     * @param Curriculum $class Curriculum
     */
    public function __construct(Customer $user)
    {
        $this->user = $user;
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->user->all();
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProducts($id)
    {
        $user = $this->show($id);

        return $user->productTransactions()->with('product')
            ->get()
            ->pluck('product');
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllServices($id)
    {   
        $user = $this->show($id);

        return $user->serviceTransactions()->with('service')
            ->get()
            ->pluck('service');
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllServiceCategories($id)
    {   
        $user = $this->show($id);

        return $user->serviceTransactions()->with('service.categories')
            ->get()
            ->pluck('service.categories')
            ->collapse()
            ->unique('id')
            ->values();
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProductCategories($id)
    {   
        $user = $this->show($id);

        return $user->productTransactions()->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse()
            ->unique('id')
            ->values();
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllServiceAgents($id)
    {   
        $user = $this->show($id);

        return $user->serviceTransactions()->with('service.agent')
            ->get()
            ->pluck('service.agent')
            ->unique('id')
            ->values();
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProductAgents($id)
    {   
        $user = $this->show($id);

        return $user->productTransactions()->with('product.agent')
            ->get()
            ->pluck('product.agent')
            ->unique('id')
            ->values();
    }

    /**
     * Returns customer's service transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getServiceTransactions($id)
    {
        $customer = $this->show($id);

        return $customer->serviceTransactions;
    }

    /**
     * Returns customer's product transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProductTransactions($id)
    {
        $customer = $this->show($id);

        return $customer->productTransactions;
    }

    /**
     * Returns all users with transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function hasProductTransactions()
    {
        return $this->user->has('productTransactions')->get();
    }

    /**
     * Returns all users with transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function hasServiceTransactions()
    {
        return $this->user->has('serviceTransactions')->get();
    }

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->user->findOrfail($id);
    }

    /**
     * Return user via slug
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->user->where('slug', $slug)->first();
    }

    /**
     * Returns one user with product transaction
     * @param $id
     * @return mixed
     */
    public function showOneWithProductTransaction($id)
    {
        return $this->user->has('productTransactions')->findOrfail($id);
    }

    /**
     * Returns one user with product transaction
     * @param $id
     * @return mixed
     */
    public function showOneWithServiceTransaction($id)
    {
        return $this->user->has('serviceTransactions')->findOrfail($id);
    }

    /**
     * Return user type
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showByType($id)
    {
        // return $this->curriculum->where('id', $id)->first()->users;
    }

    /**
     * Creates new user and returns $user
     * @param $data
     * @return mixed
     */
    public function store($request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = Customer::UNVERIFIED_USER;
        $data['verification_token'] = Customer::generateVerificationCode();
        $data['admin'] = Customer::REGULAR_USER;

        $user = $this->user::create($data);

        return $user;
    }

    /**
     * Updates user and returns $user
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $user = $this->show($id);

        if ($request->has('first_name')) {
            $user->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $user->last_name = $request->last_name;
        }

        if ($request->has('username')) {
            $user->username = $request->username;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = Customer::UNVERIFIED_USER;
            $user->verification_token = Customer::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return response()->json(['error' => 'Only verified users can modify the admin field', 'code' => 409], 409);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return response()->json(['error' => 'You need to specify a different value to update', 'code' => 422], 422);
        }

        $user->save();

        return $user;
    }

    /**
     * Deletes user
     * @param $id
     * @return int
     */
    public function destroy($id)
    {
        $user = $this->show($id);
        $user->delete();

        return $user;
    }
}