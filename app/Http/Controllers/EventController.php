<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = \App\Models\Event::with([
            'performers:id,username,name',
            'attendees:id',
        ])
        ->orderBy('starts_at')
        ->get();
    
        return view('events.index', compact('events'));
    }
    

    public function show(Event $event)
    {
        $event->load(['performers','attendees']);
        return view('events.show', compact('event'));
    }
}
