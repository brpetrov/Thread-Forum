<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_a_user_can_view_all_threads()
    {
        $thread = Thread::factory()->create();
        $response = $this->get('/threads');
        $response->assertSee($thread->title);
    }

    public function test_a_user_can_view_a_thread()
    {
        $thread = Thread::factory()->create();
        $response = $this->get($thread->path());
        $response->assertSee($thread->title);
    }

    public function test_a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $response = $this->get($thread->path());
        $response->assertSee($reply->body);
    }

    public function test_a_user_can_filter_threads_according_to_a_channel()
    {
        $this->withoutExceptionHandling();
        $channel = Channel::factory()->create();
        $threadInChannel = Thread::factory()->create(['channel_id' => $channel->id]);
        $threadNotInChannel = Thread::factory()->create();

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel);
    }

    public function test_a_user_can_filter_thread_by_name()
    {
        $user = User::factory()->create(['name' => 'JohnDoe']);
        $this->be($user);

        $threadByJohn = Thread::factory()->create(['user_id' => auth()->id()]);
        $threadNotByJohn = Thread::factory()->create();

        $this->get('threads?by=JohnDoe')
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }
}
