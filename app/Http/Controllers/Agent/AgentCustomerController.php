<?php

namespace App\Http\Controllers\Agent;

use App\Contracts\AgentRepository;
use App\Http\Controllers\ApiController;

class AgentCustomerController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, AgentRepository $agent)
    {
        $customers = $agent->getCustomers($id, $type);

        return $this->showAll($customers);
    }
}
