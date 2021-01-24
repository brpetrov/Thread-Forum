<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.show');
    }

    public function store()
    {
        request()->validate(['email' => 'required|email']);

        Mail::raw(request('body'), function ($message) {

            $message->to(request('email'))
                ->subject('Hello');
        });

        return redirect('/contact')->with('msg', 'You sent an email');
    }
}
