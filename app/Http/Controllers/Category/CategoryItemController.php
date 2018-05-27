<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryItemController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, CategoryRepository $category)
    {
        $products = $category->getItems($id, $type);

        return $this->showAll($products);
    }
}
