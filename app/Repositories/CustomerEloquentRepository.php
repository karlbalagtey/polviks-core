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
    public function getProducts($id)
    {
        $user = $this->show($id);

        return $user->products()
            ->with('product')
            ->get()
            ->pluck('product');
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getServices($id)
    {   
        $user = $this->show($id);

        return $user->services()
            ->with('service')
            ->get()
            ->pluck('service');
    }

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getServiceCategories($id)
    {   
        $user = $this->show($id);

        return $user->serviceTransactions()
            ->with('service.categories')
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
    public function getProductCategories($id)
    {   
        $user = $this->show($id);

        return $user->products()
            ->with('product.categories')
            ->get()
            ->pluck('product.categories')
            ->collapse()
            ->unique('id')
            ->values();
    }

    /**
     * Returns all product agents
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProductAgents($id)
    {   
        $user = $this->show($id);

        return $user->products()->with('product.agent')
            ->get()
            ->pluck('product.agent')
            ->unique('id')
            ->values();
    }

    /**
     * Returns all product agents
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getServiceAgents($id)
    {   
        $user = $this->show($id);

        return $user->services()->with('service.agent')
            ->get()
            ->pluck('service.agent')
            ->unique('id')
            ->values();
    }

    /**
     * Returns customer's service transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTransactions($id, $type)
    {
        $customer = $this->show($id);

        return $customer->$type;
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
    public function getProductTransaction($id)
    {
        return $this->user->has('productTransactions')->findOrfail($id);
    }

    /**
     * Returns one user with product transaction
     * @param $id
     * @return mixed
     */
    public function getServiceTransaction($id)
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

        if ($user->isClean()) {
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

    /**
     * Verify user token
     * @param  [type] $token [description]
     * @return [type]        [description]
     */
    public function verify($token)
    {
        $user = $this->user->where('verification_token', $token)->firstOrfail();

        $user->verified = Customer::VERIFIED_USER;
        $user->verification_token = null;

        $user->save();

        return $this->showMessage('The account has been verified successfully');
    }
}