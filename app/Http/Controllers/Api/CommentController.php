<?php

namespace App\Http\Controllers\Api;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index($id)
    {
        $photo = Photo::find($id);
        return $photo->comments()->with([
            'user' => function($query) {
                $query->select('id', 'name', 'social_image');
            }
        ])->get(['user_id', 'content']);
    }
}
