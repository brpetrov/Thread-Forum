<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumThreads extends TestCase
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

    public function test_a_reply_requires_a_body()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make(['body' => null]);


        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    public function test_unauthorized_users_cannot_delete_replies()
    {
        $reply = Reply::factory()->create();
        $this->delete("/replies/{$reply->id}")
            ->assertRedirect('login');

        $user = User::factory()->create();
        $this->be($user);
        $this->delete("/replies/{$reply->id}")
            ->assertStatus(403);
    }

    public function test_authorized_users_can_delete_replies()
    {
        $user = User::factory()->create();
        $this->be($user);
        $reply = Reply::factory()->create(['user_id' => auth()->id()]);
        $this->delete("/replies/{$reply->id}")->assertStatus(302);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }

    public function test_authorized_users_can_update_replies()
    {
        $user = User::factory()->create();
        $this->be($user);

        $reply = Reply::factory()->create(['user_id' => auth()->id()]);

        $updatedReply = 'You have been changed!';

        $this->patch("/replies/{$reply->id}", ['body' => $updatedReply]);
        $this->assertDatabaseHas('replies', ['id' => $reply->id, 'body' => $updatedReply]);
    }

    public function test_unauthorized_users_cannot_update_replies()
    {

        $reply = Reply::factory()->create();

        $this->patch("/replies/{$reply->id}")->assertRedirect('login');
    }
}
