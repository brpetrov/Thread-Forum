<?php

namespace App\Filters;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{

    protected $filters = ['by', 'popular'];

    protected function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id', auth()->id());
    }

    protected function popular()
    {
        return $this->builder->orderBy('replies_count', 'desc');
    }
}
