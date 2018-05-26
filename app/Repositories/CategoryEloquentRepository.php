<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryRepository;

class CategoryEloquentRepository implements CategoryRepository
{

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

        $category->update([
        	'username' => $request->categoryname,
        	'name' => $request->name,
        	'email' => $request->email
        ]);

        if($request->password != ''){
            $category->password = bcrypt($request->password);
            $category->save();
        }

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

		return $category;
	}
}