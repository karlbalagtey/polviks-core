<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Contracts\AgentRepository;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\ApiController;

class AgentController extends ApiController
{
    protected $user;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $user User repository with Eloquent
     */
    public function __construct(AgentRepository $user)
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
        $users = $this->user->hasProducts();

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
     * Show users by batch year
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showByBatch($id)
    {
        $users = $this->user->showByType($id);

        return response()->json([
            'data' => $users
        ], 200);
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
            'admin' => 'in:' . Agent::ADMIN_USER . ',' . Agent::REGULAR_USER,
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
        
        return response()->json([
            'data' => $user
        ], 200);
    }

    /**
     * Verify user
     * @return [type] [description]
     */
    public function verify($token)
    {
        $user = $this->user->verify($token);

        return $user;
    }
}
