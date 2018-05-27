<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Contracts\CustomerRepository;
use App\Http\Controllers\ApiController;

class CustomerController extends ApiController
{
    protected $user;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $user User repository with Eloquent
     */
    public function __construct(CustomerRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->getAll();

        return $this->showAll($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->show($id);

        return $this->showOne($user);
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->user->store($request);

        return $this->showOne($user, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = $this->user->show($id);

        Validator::make($request->all(), [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
            'admin' => 'in:' . Customer::ADMIN_USER . ',' . Customer::REGULAR_USER,
        ])->validate();

        $user = $this->user->update($request, $id);

        if ( ! is_array(json_decode($user, true))) {
            return $user;
        }

        return $this->showOne($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user = $this->user->destroy($id);
        
        return $this->showOne($user);
    }
}
