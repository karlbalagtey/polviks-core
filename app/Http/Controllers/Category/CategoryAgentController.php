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
    public function index($id, $type, CategoryRepository $category)
    {
        $agents = $category->getAgents($id, $type);

        return $this->showAll($agents);
    }
}
