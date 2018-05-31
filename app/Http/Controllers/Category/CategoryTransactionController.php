<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryTransactionController extends ApiController
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
    public function index($id, CategoryRepository $category)
    {
        $transactions = $category->getTransactions($id);

        return $this->showAll($transactions);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type, CategoryRepository $category)
    {
        $transactions = $category->getTransactionsByType($id, $type);

        return $this->showAll($transactions);
    }
}
