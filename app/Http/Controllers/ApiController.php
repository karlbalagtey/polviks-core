<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Http\Requests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ApiController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
    	// $this->middleware('auth:api');
    }

}