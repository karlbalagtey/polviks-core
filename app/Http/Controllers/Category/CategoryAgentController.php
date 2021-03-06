<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryAgentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }

    /**
     * Display a listing of all the agents in this category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $agents = $category->getAgents($category_id);

        return $this->showAll($agents);
    }

    /**
     * Display a listing of all the agents in this category by type.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type, CategoryRepository $category)
    {
        $agents = $category->getAgentsByType($id, $type);

        return $this->showAll($agents);
    }
}
