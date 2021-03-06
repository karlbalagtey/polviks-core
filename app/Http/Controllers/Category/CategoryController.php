<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Contracts\CategoryRepository;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\ApiController;
use App\Transformers\CategoryTransformer;
use Illuminate\Support\Facades\Validator;

class CategoryController extends ApiController
{
    protected $category;

    /**
     * Constructor injected with Category Repository
     * @param CategoryRepository $category Category Repository with Eloquent
     */
    public function __construct(CategoryRepository $category)
    {
        $this->middleware('client.credentials')->only(['index', 'show']);
        $this->middleware('auth:admin-api')->except(['index', 'show']);
        $this->middleware('transform.input:' . CategoryTransformer::class)->only(['store', 'update']);

        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->getAll();

        return $this->showAll($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'description' => 'required',
        ])->validate();
        
        $category = $this->category->store($request);

        return $this->showOne($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->show($id);

        return $this->showOne($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = $this->category->update($request, $id);

        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->category->destroy($id);

        return $category;
    }
}
