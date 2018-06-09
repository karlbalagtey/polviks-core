<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function authorize($ability, $arguments = [])
    // {
    // 	if (Auth::guard('admin-api')->check()) {
    // 		Auth::shouldUse('admin-api');
    // 	}

    // 	if (Auth::guard('customer-api')->check()) {
    // 		Auth::shouldUse('customer-api');
    // 	}

    //    	if (Auth::guard('agent-api')->check()) {
    // 		Auth::shouldUse('agent-api');
    // 	}

    // 	$this->baseAuthorize($ability, $arguments);
    // }
}
