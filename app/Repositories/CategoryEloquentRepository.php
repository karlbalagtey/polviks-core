<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\ApiResponser;
use App\Contracts\CategoryRepository;

class CategoryEloquentRepository implements CategoryRepository
{
    use ApiResponser;

	protected $category;

    /**
     * Constructor injects Category Model
     * @param User       $category  User model
     * @param Curriculum $class Curriculum
     */
	public function __construct(Category $category)
	{
		$this->category = $category;
	}

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
	{
		return $this->category->all();
	}

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
	{
		return $this->category->findOrfail($id);
	}

    /**
     * Return category via slug
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->category->where('slug', $slug)->first();
    }

    /**
     * Creates new user and returns $category
     * @param $data
     * @return mixed
     */
    public function store($request)
    {
        $category = $this->category::create($request->all());

        return $category;
    }

    /**
     * Updates user and returns $category
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
	{
        $category = $this->show($id);

        $category->fill($request->only([
        	'name',
        	'description',
        ]));

        if ($category->isClean()) {
            return $this->errorResponse('You need to change the values to update', 422);
        }

        $category->save();

        return $category;
    }

    /**
     * Deletes category
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
        $category = $this->show($id);
        $category->delete();

		return $this->showOne($category);
	}
}