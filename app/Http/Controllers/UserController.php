<?php

namespace App\Http\Controllers;

use App\Contracts\CurriculumRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Contracts\UserRepository;

class UserController extends Controller
{

    protected $user;
    protected $class;

    public function __construct(UserRepository $user)
    {
        $this->middleware('client');
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = $this->user->index();

        return response()->json([
            'data' => $users
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = $this->user->show($id);

        return view('users.show', compact('user'));

    }

    /**
     * Show users by batch year
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showByBatch($id)
    {
        $users = $this->user->showByType($id);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->show($id);
        $curriculum = $this->class->index();

        return view('users.edit', ['user' => $user, 'curriculum' => $curriculum]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->user->update($request, $id);

        session()->flash('flash_message', 'Successfully updated user');

        return redirect('users');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->user->destroy($id);

        session()->flash('flash_message', 'User successfully deleted');

        return redirect('users');    

    }
}
