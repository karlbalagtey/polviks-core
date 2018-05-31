<?php

namespace App\Http\Controllers\Agent;

use App\Contracts\AgentRepository;
use App\Http\Controllers\ApiController;

class AgentTransactionController extends ApiController
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
        $transactions = $agent->getTransactions($id, $type);

        return $this->showAll($transactions);
    }
}
