<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;


    public function test_a_thread_has_a_creator()
    {
        $thread = Thread::factory()->create();
        $this->assertInstanceOf(User::class, $thread->user);
    }


    public function test_a_thread_has_replies()
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);
        $this->assertTrue($thread->replies->contains($reply));
    }


    public function test_a_thread_can_add_a_reply()
    {
        $thread = Thread::factory()->create();
        $thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $thread->replies);
    }

    public function test_a_thread_belongs_to_a_channel()
    {
        $this->withoutExceptionHandling();
        $thread = Thread::factory()->create();
        $this->assertInstanceOf('App\Models\Channel', $thread->channel);
    }

    public function test_a_tread_can_have_a_string_path()
    {
        $thread = Thread::factory()->create();
        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}", $thread->path());
    }
}
