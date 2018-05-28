<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryServiceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $services = $category->getServices($category_id);

        return $this->showAll($services);
    }
}
