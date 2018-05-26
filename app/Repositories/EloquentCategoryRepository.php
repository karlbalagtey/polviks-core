<?php

namespace App\Repositories;

use App\Agent;
use App\Contracts\CategoryRepository;

class EloquentCategoryRepository implements CategoryRepository
{

	protected $category;

    /**
     * Constructor injects Agent Model
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
		return $this->category->where('id', $id)->first();
	}

    /**
     * Return user type
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function showByType($id)
    {
        // return $this->curriculum->where('id', $id)->first()->user;
    }

    /**
     * Creates new user and returns $category
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $category = $this->category::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // $category->curriculum()->attach($data['curriculum']);

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
     * Deletes user
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
		return $this->category::destroy($id);
	}

}