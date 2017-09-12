<?php

namespace Tests\Unit;

use App\User;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
	use DatabaseMigrations;

	/**
     * @test
     */
    public function comment_determines_its_author()
    {
    	$user = factory(User::class)->create();

    	$comment = factory(Comment::class)->create([
    		'user_id' => $user->id
		]);

    	$commentByAuthor = $comment->wasCommentedBy($user);

    	$this->assertTrue($commentByAuthor);
    }
}
