<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\CommentCreated;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->photo_id = $id;
        $comment->content = $request->input('content');
        $saved = $comment->save();

        event(new CommentCreated($comment));

        $data = [];
        $data['success'] = $saved;
        return $data;
    }
}
