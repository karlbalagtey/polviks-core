<?php

namespace App\Http\Controllers\Agent;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Contracts\AgentRepository;
use App\Contracts\ServiceRepository;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AgentServiceRequest;

class AgentServiceController extends ApiController
{
    protected $user;
    protected $service;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $user User repository with Eloquent
     */
    public function __construct(AgentRepository $user, ServiceRepository $service)
    {
        $this->user = $user;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($agent_id)
    {
        $services = $this->user->getServices($agent_id);

        return $this->showAll($services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgentServiceRequest $request, $id)
    {
        $service = $this->service->store($request, $id);
    
        return $this->showOne($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($agent_id, $service_id)
    {
        $service = $this->service->getAgentService($agent_id, $service_id);
    
        return $this->showOne($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($agent_id, $service_id, Request $request)
    {
        Validator::make($request->all(), [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Service::AVAILABLE_SERVICE . ',' . Service::UNAVAILABLE_SERVICE,
        ])->validate();

        $service = $this->service->update($agent_id, $service_id, $request);

        return $this->showOne($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($agent_id, $service_id)
    {
        return $this->service->destroy($agent_id, $service_id);
    }
}
