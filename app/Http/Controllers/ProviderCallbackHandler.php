<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

trait ProviderCallbackHandler
{
    public function handleCallback($provider) {
        $providerUser = Socialite::driver($provider)->user();

        $user = User::where($provider . "_id", $providerUser->getId())
            ->orWhere('email', $providerUser->getEmail())
            ->first();

        if ($user) {
            $user[$provider . "_id"] = $providerUser->getId();
            $user->social_image = $providerUser->getAvatar();
            $user->save();
        } else {
            $user = new User();
            $user[$provider . "_id"] = $providerUser->getId();
            $user->name = $providerUser->getName();
            $user->email = $providerUser->getEmail();
            $user->social_image = $providerUser->getAvatar();
            $user->password = '';
            $user->save();
        }

        Auth::login($user);
        return redirect('/home');
    }
}
