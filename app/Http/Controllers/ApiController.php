<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
    	$this->middleware('auth:admin-api,customer-api,agent-api');
    }

    protected function allowedAdminAction()
    {
    	if (Gate::denies('admin-action')) {
    		throw new AuthorizationException("This action is unauthorized in the Gate");
    	}
    }
}