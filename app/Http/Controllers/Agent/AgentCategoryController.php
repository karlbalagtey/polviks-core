<?php

namespace App\Http\Controllers\Agent;

use App\Contracts\AgentRepository;
use App\Http\Controllers\ApiController;

class AgentCategoryController extends ApiController
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
        $categories = $agent->getCategories($id, $type);

        return $this->showAll($categories);
    }
}
