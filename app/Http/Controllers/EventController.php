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
    
    public function show(\App\Models\Event $event)
    {
        $event->load([
            'performers:id,username,name',
            'attendees:id',
        ]);
    
        $isGoing = auth()->check()
            ? $event->attendees->contains(auth()->id())
            : false;
    
        return view('events.show', compact('event', 'isGoing'));
    }
}
