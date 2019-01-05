<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryCustomerController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }

    /**
     * Display a listing of all the customers in this category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $customers = $category->getCustomers($category_id);

        return $this->showAll($customers);
    }

    /**
     * Display a listing of all the customers by type of category
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type, CategoryRepository $category)
    {
        $customers = $category->getCustomersByType($id, $type);

        return $this->showAll($customers);
    }
}
