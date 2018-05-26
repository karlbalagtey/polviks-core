<?php

namespace App\Repositories;

use App\Models\Service;
use App\Contracts\ServiceRepository;

class ServiceEloquentRepository implements ServiceRepository
{

	protected $service;

    /**
     * Constructor injects Agent Model
     * @param User       $service  User model
     * @param Curriculum $class Curriculum
     */
	public function __construct(Service $service)
	{
		$this->service = $service;
	}

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
	{
		return $this->service->all();
	}

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
	{
		return $this->service->findOrfail($id);
	}

    /**
     * Return service via slug
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function showBySlug($slug)
    {
        return $this->service->where('slug', $slug)->first();
    }

    /**
     * Creates new user and returns $service
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $service = $this->service::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // $service->curriculum()->attach($data['curriculum']);

        return $service;
    }

    /**
     * Updates user and returns $service
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
	{
        $service = $this->show($id);

        $service->update([
        	'username' => $request->servicename,
        	'name' => $request->name,
        	'email' => $request->email
        ]);

        if($request->password != ''){
            $service->password = bcrypt($request->password);
            $service->save();
        }

        return $service;
    }

    /**
     * Deletes service
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
        $service = $this->show($id);
        $service->delete();

		return $service;
	}

}