<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        $activities = $this->getActivity($user);

        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => \App\Models\Activity::feed($user)
        ]);
    }

    public function getActivity(User $user)
    {
        return $user->activities()->latest()->with('subject')->take(50)->get()->groupBy(function ($activities) {
            return $activities->created_at->format('Y-m-d');
        });
    }
}
