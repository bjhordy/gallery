<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->first();
        if (!$user)
            return redirect('/');

        $galleries = $user->galleries()->with(['photos' => function ($query) {
            $query->select(['id', 'file_name', 'name', 'description', 'gallery_id']);
        }])->get();
        // Gallery::where('user_id', $user->id)->get();

        // Book::all();
        // Book::with('author')->get();

        return view('guest.profile.show')->with(compact('user', 'galleries'));
    }
}
