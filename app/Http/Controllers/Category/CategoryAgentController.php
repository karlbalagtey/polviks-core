<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryAgentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $agents = $category->getAgents($category_id);

        return $this->showAll($agents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type, CategoryRepository $category)
    {
        $agents = $category->getAgentsByType($id, $type);

        return $this->showAll($agents);
    }
}
