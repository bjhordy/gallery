<?php

namespace App\Http\Controllers\Guest;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    public function show($username, $id)
    {
        $photo = Photo::findOrFail($id);
        $user = $photo->gallery->user;
        return view('guest.photos.show')->with(compact('photo', 'user'));
    }
}
