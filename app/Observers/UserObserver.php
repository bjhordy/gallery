<?php

namespace App\Observers;

use App\Mail\UserWelcome;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{

    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        // Debugbar::info('Se capturó el evento created del modelo User');
        // Debugbar::info($user);

        if ($user->email) {
            Mail::to($user)
                ->send(new UserWelcome($user));
        }

    }

}