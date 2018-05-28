<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryCustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $customers = $category->getCustomers($category_id);

        return $this->showAll($customers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type, CategoryRepository $category)
    {
        $customers = $category->getCustomersByType($id, $type);

        return $this->showAll($customers);
    }
}
