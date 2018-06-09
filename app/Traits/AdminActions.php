<?php

namespace App\Traits;

use Auth;

trait AdminActions
{
    public function before($user, $ability)
    {
        if (Auth::guard('customer-api')) {
            return true;
        }
    }
}