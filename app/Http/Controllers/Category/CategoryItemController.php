<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryItemController extends ApiController
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
    public function index($category_id, CategoryRepository $category)
    {
        $products = $category->getItems($category_id);

        return $this->showAll($products);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($category_id, $type, CategoryRepository $category)
    {
        $products = $category->getItemsByType($category_id, $type);

        return $this->showAll($products);
    }
}
