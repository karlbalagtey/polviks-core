<?php

namespace App\Repositories;

use App\User;
use App\Contracts\UserRepository;

class EloquentUserRepository implements UserRepository
{

	protected $user;

    /**
     * Constructor injects Admin Users
     * @param User       $user  User model
     * @param Curriculum $class Curriculum
     */
	public function __construct(User $user)
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
    public function store($request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin'] = User::REGULAR_USER;

        $user = $this->user::create($data);

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

        if ($request->has('first_name')) {
            $user->first_name = $request->first_name;
        }

        if ($request->has('last_name')) {
            $user->last_name = $request->last_name;
        }

        if ($request->has('username')) {
            $user->username = $request->username;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('admin')) {
            if (!$user->isVerified()) {
                return response()->json(['error' => 'Only verified users can modify the admin field', 'code' => 409], 409);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {
            return response()->json(['error' => 'You need to specify a different value to update', 'code' => 422], 422);
        }

        $user->save();

        return $user;
    }

    /**
     * Deletes user
     * @param $id
     * @return int
     */
    public function destroy($id)
	{
        $user = $this->show($id);

		return $user->delete();
	}

}