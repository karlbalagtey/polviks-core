<?php

namespace App\Repositories;

use App\Agent;
use App\Contracts\AgentRepository;

class EloquentAgentRepository implements AgentRepository
{

	protected $user;

    /**
     * Constructor injects Agent Model
     * @param User       $user  User model
     * @param Curriculum $class Curriculum
     */
	public function __construct(Agent $user)
	{
		$this->user = $user;
	}

    /**
     * Returns all users
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
	{
		return $this->user->all();
	}

    /**
     * Returns one user
     * @param $id
     * @return mixed
     */
    public function show($id)
	{
		return $this->user->where('id', $id)->first();
	}

    /**
     * Return user type
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
	public function showByType($id)
    {
        // return $this->curriculum->where('id', $id)->first()->users;
    }

    /**
     * Creates new user and returns $user
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $user = $this->user::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // $user->curriculum()->attach($data['curriculum']);

        return $user;
    }

    /**
     * Updates user and returns $user
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
	{
        $user = $this->show($id);

        $user->update([
        	'username' => $request->username,
        	'name' => $request->name,
        	'email' => $request->email
        ]);

        if($request->password != ''){
            $user->password = bcrypt($request->password);
            $user->save();
        }

        return $user;
    }

    /**
     * Deletes user
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
		return $this->user::destroy($id);
	}

}