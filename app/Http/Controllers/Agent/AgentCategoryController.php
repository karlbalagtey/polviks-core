<?php

namespace App\Http\Controllers\Agent;

use App\Contracts\AgentRepository;
use App\Http\Controllers\ApiController;

class AgentCategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:admin-api,agent-api');
        $this->middleware('scope:read-general')->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, AgentRepository $agent)
    {
        $categories = $agent->getCategories($id, $type);

        return $this->showAll($categories);
    }
}
