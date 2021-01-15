<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_it_has_an_owner()
    {
        $thread = Thread::factory()->create();

        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $response = $this->get($thread->path());
        $response->assertSee($reply->user->name);
    }
}
