<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{

    use DatabaseMigrations;

    public function test_guests_cannot_favorite_anything()
    {

        $this->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    public function test_an_auth_user_can_favorite_any_reply()
    {
        $user = User::factory()->create();
        $this->be($user);

        $reply = Reply::factory()->create();

        $this->post('/replies/' . $reply->id . '/favorites');


        $this->assertCount(1, $reply->favorites);
    }

    public function test_an_auth_user_can_favorite_reply_only_once()
    {
        $user = User::factory()->create();
        $this->be($user);

        $reply = Reply::factory()->create();

        try {
            $this->post('/replies/' . $reply->id . '/favorites');
            $this->post('/replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice');
        }



        $this->assertCount(1, $reply->favorites);
    }
}
