<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryItemController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials');
    }

    /**
     * Display a listing of all the items (Products and Services).
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $productsAndServices = $category->getItems($category_id);

        return $this->showAll($productsAndServices);
    }

    /**
     * Display a listing of all the products and services with filter type.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($category_id, $type, CategoryRepository $category)
    {
        $productsAndServices = $category->getItemsByType($category_id, $type);

        return $this->showAll($productsAndServices);
    }
}
