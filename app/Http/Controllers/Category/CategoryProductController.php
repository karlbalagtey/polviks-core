<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryProductController extends ApiController
{

    public function __construct(CategoryRepository $category)
    {
        $this->middleware('client.credentials')->only(['index']);    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id, CategoryRepository $category)
    {
        $products = $category->getProducts($category_id);

        return $this->showAll($products);
    }
}
