<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class BitbucketLoginController extends Controller
{
    use ProviderCallbackHandler;

    public function redirectToProvider()
    {
        return Socialite::driver('bitbucket')->redirect();
    }

    public function handleProviderCallback()
    {
        return $this->handleCallback('bitbucket');
    }
}
