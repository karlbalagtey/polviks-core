<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Contracts\CustomerRepository;
use App\Transformers\UserTransformer;
use App\Mail\Customer\CustomerCreated;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;

class CustomerController extends ApiController
{
    protected $user;

    /**
     * Constructor injected with Admin User Repository
     * @param UserRepository $user User repository with Eloquent
     */
    public function __construct(Request $request, CustomerRepository $user)
    {
        parent::__construct();

        $this->middleware('client.credentials')->only(['store', 'resend']);
        $this->middleware('transform.input:' . UserTransformer::class)->only(['store', 'update']);
        $this->middleware('scope:read-general')->only('show');
        $this->middleware('can:view,App\Models\Customer')->only('show');

        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->forAdminOnly();

        $users = $this->user->getAll();

        return $this->showAll($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (Auth::guard('customer-api')->check() && Auth::guard('customer-api')->user()->id == $id) {
            $customer = $this->user->show($id);

            return $this->showOne($customer);
        // }

        // return $this->errorResponse('This is not your account', 403);
    }

    /**
     * Store the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->user->store($request);

        return $this->showOne($user, 201);
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
        Validator::make($request->all(), [
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'min:6|confirmed',
        ])->validate();

        $user = $this->user->update($request, $id);

        return $this->showOne($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $user = $this->user->destroy($id);
        
        return $this->showOne($user);
    }

    /**
     * Verify user
     * @return [type] [description]
     */
    public function verify($token)
    {
        $user = $this->user->verify($token);

        return $user;
    }

    /**
     * Verify user
     * @return [type] [description]
     */
    public function resend($id)
    {
        $user = $this->user->show($id);

        if ($user->isVerified()) {
            return $this->errorResponse('This user has already been verified', 409);
        }

        retry(5, function() use ($user) {
            Mail::to($user)->send(new CustomerCreated($user));
        }, 100);

        return $this->showMessage('The verification email has been re-sent');
    }
}
