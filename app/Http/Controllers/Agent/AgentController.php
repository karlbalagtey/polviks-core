<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Contracts\AgentRepository;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\ApiController;

class AgentController extends ApiController
{

    protected $user;

    /**
     * Constructor inject Agent Repository
     * @param AgentRepository $agent Agent Repository with EloquentAgentRepository
     */
    public function __construct(AgentRepository $agent)
    {
        $this->middleware('client');
        $this->user = $agent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->index();

        return response()->json([
            'data' => $users
        ], 200);
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

        return response()->json([
            'data' => $user
        ], 200);
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

        return response()->json([
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->update($request, $id);

        return response()->json([
            'data' => $user
        ], 200);
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
}
