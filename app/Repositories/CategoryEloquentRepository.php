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
     * Returns all categories
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
	{
		return $this->category->all();
	}

    /**
     * Returns all items by type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getItems($id, $type)
    {
        $category = $this->show($id);

        return $category->$type;
    }

    /**
     * Returns all agents by type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAgents($id, $type)
    {
        $category = $this->show($id);

        return $category->$type()
            ->with('agent')
            ->get()
            ->pluck('agent')
            ->unique()
            ->values();
    }

    /**
     * Returns all agents by type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCustomers($id, $type)
    {
        $category = $this->show($id);

        return $category->$type()
            ->whereHas('transactions')
            ->with('transactions.customer')
            ->get()
            ->pluck('transactions')
            ->collapse()
            ->pluck('customer')
            ->unique('id')
            ->values();
    }

    /**
     * Returns all transactions by type
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTransactions($id, $type)
    {
        $category = $this->show($id);

        return $category->$type()
            ->whereHas('transactions')
            ->with('transactions')
            ->get()
            ->pluck('transactions')
            ->collapse();
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

		return $category;
	}
}