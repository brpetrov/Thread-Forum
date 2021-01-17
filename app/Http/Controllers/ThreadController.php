<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Thread;
use App\Models\User;
use App\Filters\ThreadFilters;
use Illuminate\Http\Request;

class ThreadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::latest()->filter($filters);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }


        // if (request('popular')) {
        //     $threads->orderBy('replies_count', 'desc');
        // }

        if (request()->wantsJson()) {
            return $threads;
        }

        $threads = $threads->get();
        return view('threads.index', compact('threads'));
    }


    public function create()
    {
        $channels = Channel::all();
        return view('threads.create', compact('channels'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id'
        ]);

        $thread = Thread::create([
            'user_id' => auth()->id(),
            'channel_id' => request('channel_id'),
            'title' => request('title'),
            'body' => request('body')
        ]);

        return redirect($thread->path());
    }

    public function show(Channel $channel, Thread $thread)
    {
        return view('threads.show', [
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(5)
        ]);
    }

    public function edit(Thread $thread)
    {
        //
    }

    public function update(Request $request, Thread $thread)
    {
        //
    }


    public function destroy(Thread $thread)
    {
        //
    }
}
