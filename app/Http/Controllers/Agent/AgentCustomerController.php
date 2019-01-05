<?php

namespace App\Http\Controllers\Agent;

use App\Contracts\AgentRepository;
use App\Http\Controllers\ApiController;

class AgentCustomerController extends ApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:admin-api,agent-api');
    }

    /**
     * Display a listing of all the customers for this agent.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, AgentRepository $agent)
    {
        $customers = $agent->getCustomers($id, $type);

        return $this->showAll($customers);
    }
}
