<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SteamAuth;
use App\User;
use Auth;

class SteamLoginController extends Controller
{
    use ProviderCallbackHandler;

    protected $steam;
    protected $redirectURL = '/';

    public function __construct(SteamAuth $steam)
    {
        $this->steam = $steam;
    }

    public function redirectToProvider()
    {
        return $this->steam->redirect();
    }

    public function handleProviderCallback()
    {
        if ($this->steam->validate()) {
            $provider = "steam";
            $providerUser = $this->steam->getUserInfo();
            dd($providerUser);
            $user = User::where($provider . "_id", $providerUser->getSteamId())
                ->orWhere('email', $providerUser->personaname)
                ->first();

            if ($user) {
                $user[$provider . "_id"] = $providerUser->getSteamId();
                $user->social_image = $providerUser->avatarfull;
                $user->save();
            } else {
                $user = new User();
                $user[$provider . "_id"] = $providerUser->steamID64;
                $user->name = $providerUser->personaname;
                $user->email = $providerUser->personaname;
                $user->social_image = $providerUser->avatarfull;
                $user->password = '';
                $user->save();
            }

            Auth::login($user);
            return redirect('/home');
        }
        return $this->redirectToProvider();
    }
}
