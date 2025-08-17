<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Event $event)
    {
        $user = $request->user();

        if ($event->attendees()->where('user_id', $user->id)->exists()) {
            return back()->with('status', 'Je bent al ingeschreven voor dit event.');
        }

        if ($event->attendees()->count() >= $event->capacity) {
            return back()->withErrors(['capacity' => 'Jammer, dit event zit vol.']);
        }

        $event->attendees()->attach($user->id);

        return back()->with('status', 'Je inschrijving is bevestigd.');
    }

    public function destroy(Request $request, Event $event)
    {
        $request->user()->loadMissing('events'); // niet nodig, maar kan
        $request->user()->belongsToMany(\App\Models\Event::class, 'event_registrations')->detach($event->id);

        // of: $request->user()->events()->detach($event->id); als je een relatie events() op User zet.

        return back()->with('status', 'Je bent uitgeschreven.');
    }
}
