<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:255'],
            'email'   => ['required','email'],
            'subject' => ['nullable','string','max:255'],
            'message' => ['required','string','max:5000'],
        ]);

        $msg = ContactMessage::create($data);

        // stuur naar from.address (stel die in .env in)
        Mail::to(config('mail.from.address'))->send(new ContactFormSubmitted($msg));

        return back()->with('status','Bedankt! Je bericht is verzonden.');
    }
}
