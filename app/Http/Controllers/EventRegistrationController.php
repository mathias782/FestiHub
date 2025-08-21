<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Event $event)
    {
        $userId = $request->user()->id;

        if ($event->attendees()->where('user_id', $userId)->exists()) {
            return back()->with('status', 'You are already registered.');
        }

        if ($event->attendees()->count() >= $event->capacity) {
            return back()->with('status', 'Event is full.');
        }

        $event->attendees()->attach($userId);
        return back()->with('status', 'Registered.');
    }

    public function destroy(Request $request, Event $event)
    {
        $userId = $request->user()->id;
        $event->attendees()->detach($userId);
        return back()->with('status', 'Unregistered.');
    }
}
