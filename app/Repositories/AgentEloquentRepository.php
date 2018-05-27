<?php

namespace App\Repositories;

use App\Models\Agent;
use App\Traits\ApiResponser;
use App\Contracts\AgentRepository;

class AgentEloquentRepository implements AgentRepository
{

    use ApiResponser;

    protected $user;

    /**
     * Constructor injects Admin Users
     * @param User       $user  User model
     * @param Curriculum $class Curriculum
     */
    public function __construct(Agent $user)
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
     * Returns user's products
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProducts($id)
    {
        $agent =  $this->show($id);

        return $agent->products;
    }

    /**
     * Return agent's services
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getServices($id)
    {
        $agent =  $this->show($id);

        return $agent->services;
    }

    /**
     * Returns all users transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTransactions($id, $type)
    {
        $agent = $this->show($id);

        return $agent->$type()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
    }

    /**
     * Returns all agents customers
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCustomers($id, $type)
    {
        $agent = $this->show($id);

        return $agent->$type()
            ->whereHas('transactions')
            ->with('transactions.customer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('customer')
            ->unique('id')
            ->values();
    }

    /**
     * Returns all users transactions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories($id, $type)
    {
        $agent = $this->show($id);

        return $agent->$type()
            ->whereHas('categories')
            ->with('categories')
            ->get()
            ->pluck('categories')
            ->collapse()
            ->unique('id')
            ->values();
    }    

    /**
     * Returns all users with products
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function hasProducts()
    {
        return $this->user->has('products')->get();
    }

    /**
     * Returns all users with services
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function hasServices()
    {
        return $this->user->has('services')->get();
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
     * Return user type
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->user->where('slug', $slug)->first();
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
        $data['verified'] = Agent::UNVERIFIED_USER;
        $data['verification_token'] = Agent::generateVerificationCode();
        $data['admin'] = Agent::REGULAR_USER;

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
            $user->verified = Agent::UNVERIFIED_USER;
            $user->verification_token = Agent::generateVerificationCode();
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