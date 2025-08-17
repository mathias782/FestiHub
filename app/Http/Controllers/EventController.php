<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::with(['performers','attendees'])
            ->orderBy('starts_at')
            ->paginate(12);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load(['performers','attendees']);
        return view('events.show', compact('event'));
    }
}
