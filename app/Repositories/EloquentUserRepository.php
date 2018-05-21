<?php

namespace App\Repositories;

use App\Curriculum;
use App\User;
use App\Contracts\UserRepository;

class EloquentUserRepository implements UserRepository
{

	protected $user;
	protected $curriculum;

	public function __construct(User $user, Curriculum $class)
	{
		$this->user = $user;
		$this->curriculum = $class;
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

	public function showByType($id)
    {
        return $this->curriculum->where('id', $id)->first()->users;
    }

    /**
     * Creates new user
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $user = $this->user::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->curriculum()->attach($data['curriculum']);

        return $user;
    }

    /**
     * Updates user
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
	{
        $user = $this->show($id);
        $inCurriculum = $user->curriculum()->where('user_id', $user->id)->where('curricula_id', $request->curriculum)->exists();

        $user->update([
        	'username' => $request->username,
        	'name' => $request->name,
        	'email' => $request->email
        ]);

        if($request->password != ''){
            $user->password = bcrypt($request->password);
            $user->save();
        }

        if(!$inCurriculum){
            return $user->curriculum()->attach($request->curriculum);
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