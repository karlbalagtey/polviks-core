<?php

namespace App\Http\Controllers\Category;

use App\Contracts\CategoryRepository;
use App\Http\Controllers\ApiController;

class CategoryTransactionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id, $type, CategoryRepository $category)
    {
        $transactions = $category->getTransactions($id, $type);

        return $this->showAll($transactions);
    }
}
