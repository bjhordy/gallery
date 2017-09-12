<?php

namespace Tests\Unit;

use App\Gallery;
use App\Photo;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function is_user_author_of_its_photos()
    {
        $user = factory(User::class)->create();

        $gallery = factory(Gallery::class)->make();
        $user->galleries()->save(
            $gallery
        );

        $photo = factory(Photo::class)->make();
        $gallery->photos()->save(
            $photo
        );

        $this->assertTrue($user->isAuthor($photo));
    }
}
