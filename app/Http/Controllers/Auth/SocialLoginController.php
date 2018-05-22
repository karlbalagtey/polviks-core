<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Socialite;

class SocialLoginController extends Controller
{
    /**
     * Redirect the user to the Social authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($type)
    {
        return Socialite::driver($type)->redirect();
    }

    /**
     * Obtain the user information from Socialite.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($type)
    {
        $user = Socialite::driver($type)->user();

        // $user->token;
    }
}
