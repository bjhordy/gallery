<?php

namespace Tests\Feature;

use App\Gallery;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GalleryControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function user_can_create_galleries()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        factory(Gallery::class)->create([
            'user_id' => Auth::user()->id
        ]);

        $this->assertDatabaseHas('galleries', [
            'user_id' => Auth::user()->id
        ]);
    }

    /**
     * @test
     */
    public function user_can_see_the_gallery_panel_at_home()
    {
        $user = factory(User::class)->create();
        Auth::login($user);

        $response = $this->get('/home');
        $response->assertSee('Galerías');
    }

    /**
     * @test
     */
    public function only_authenticated_users_can_access_to_home()
    {
        // factory(User::class)->create();
        // not login method
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function only_authenticated_users_can_see_the_galleries_registration_form()
    {
        $response = $this->get('/galleries/create');
        $response->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function a_user_cannot_update_the_gallery_of_others()
    {
        // author
        $user = factory(User::class)->create();
        $gallery = factory(Gallery::class)->make();
        $originalName = $gallery->name;
        $user->galleries()->save(
            $gallery
        );

        // Log::info($gallery);

        // another user
        $otherUser = factory(User::class)->create();
        Auth::login($otherUser);
        $response = $this->post('/galleries/'.$gallery->id.'/edit', [
            'name' => 'edited',
            'description' => 'edited'
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('galleries', [
            'id' => $gallery->id,
            'name' => $originalName
        ]);
    }
}
