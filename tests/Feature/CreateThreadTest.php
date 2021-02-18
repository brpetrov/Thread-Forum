<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guests_can_not_create_a_new_thread()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        $this->withoutExceptionHandling();

        //added something in composer.json and two methods inside tests/utilities/functions.php
        //not sure if I will ever use that
        // simple way of doing it:
        // $thread = Thread::factory()->make();
        $thread = make(Thread::class);

        $respone = $this->post('/threads', $thread->toArray());

        $this->get('/threads/create')
            ->assertRedirect('login');

        $this->post('/threads')
            ->assertRedirect('/login');
    }


    public function test_an_auth_user_can_create_a_new_thread()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->make();

        $respone = $this->post('/threads', $thread->toArray());


        $this->get($respone->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_a_thread_requires_a_title()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->make(['title' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->make(['body' => null]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel()
    {
        $user = User::factory()->create();
        $this->be($user);

        Channel::factory()->count(2)->create();

        $thread = Thread::factory()->make(['channel_id' => null]);
        $thread = Thread::factory()->make(['channel_id' => 999]);

        $this->post('/threads', $thread->toArray())
            ->assertSessionHasErrors('channel_id');
    }

    public function test_unauthorized_users_cannot_delete_threads()
    {
        $thread = Thread::factory()->create();
        $this->delete($thread->path())->assertRedirect('/login');
        $user = User::factory()->create();
        $this->be($user);
        $this->delete($thread->path())->assertStatus(403);
    }

    public function test_authorized_users_can_delete_threads()
    {
        $user = User::factory()->create();
        $this->be($user);
        $thread = Thread::factory()->create(['user_id' => auth()->id()]);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $respone = $this->json('DELETE', $thread->path());
        $respone->assertStatus(204);

        $this->assertDatabaseMissing('threads', ['id' => $thread->id]);
        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}
