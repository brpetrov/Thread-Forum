<?php

namespace Tests\Unit;

use App\Models\Activity;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    public function test_records_activity_when_a_thread_is_created()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->create();

        $this->assertDatabaseHas('activities', [
            'type' => 'created_' . strtolower((new \ReflectionClass($thread))->getShortName()),
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => 'App\Models\Thread'
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    public function test_it_records_activity_when_a_reply_is_created()
    {
        $user = User::factory()->create();
        $this->be($user);

        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);

        $this->assertEquals(2, Activity::count());
    }
}
