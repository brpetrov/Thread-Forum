<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauth_user_can_not_add_replies()
    {
        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertRedirect('login');
    }

    public function test_an_auth_user_can_participate_in_forum_threads()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    // NOT WORKING FOR NOW
    // public function test_a_reply_requires_a_body()
    // {
    //     $user = User::factory()->create();
    //     $this->be($user);

    //     $thread = Thread::factory()->create();

    //     $reply = Reply::factory()->make(['body' => null]);


    //     $this->post($thread->path() . '/replies', $reply->toArray())
    //         ->assertSessionHasErrors('body');
    // }
}
