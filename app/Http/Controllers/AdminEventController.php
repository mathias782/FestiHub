<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','is_admin']);
    }

    public function index()
    {
        $events = Event::withCount('attendees')->orderBy('starts_at')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get(['id','name','username','email']);
        return view('admin.events.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['required','string','max:255'],
            'location'   => ['nullable','string','max:255'],
            'description'=> ['nullable','string'],
            'starts_at'  => ['required','date'],
            'ends_at'    => ['nullable','date','after_or_equal:starts_at'],
            'capacity'   => ['required','integer','min:1'],
            'image'      => ['nullable','image','max:4096'],
            'performers' => ['nullable','array'],
            'performers.*' => ['integer','exists:users,id'],
        ]);

        $path = $request->hasFile('image')
            ? $request->file('image')->store('events', 'public')
            : null;

        $event = Event::create([
            'title' => $data['title'],
            'location' => $data['location'] ?? null,
            'description' => $data['description'] ?? null,
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'] ?? null,
            'capacity' => $data['capacity'],
            'image_path' => $path,
        ]);

        $event->performers()->sync($data['performers'] ?? []);

        return redirect()->route('admin.events.edit', $event)->with('status', 'Event aangemaakt.');
    }

    public function edit(Event $event)
    {
        $users = User::orderBy('name')->get(['id','name','username','email']);
        $event->load(['performers','attendees']);
        return view('admin.events.edit', compact('event','users'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title'      => ['required','string','max:255'],
            'location'   => ['nullable','string','max:255'],
            'description'=> ['nullable','string'],
            'starts_at'  => ['required','date'],
            'ends_at'    => ['nullable','date','after_or_equal:starts_at'],
            'capacity'   => ['required','integer','min:1'],
            'image'      => ['nullable','image','max:4096'],
            'performers' => ['nullable','array'],
            'performers.*' => ['integer','exists:users,id'],
        ]);

        if ($request->hasFile('image')) {
            if ($event->image_path) {
                Storage::disk('public')->delete($event->image_path);
            }
            $event->image_path = $request->file('image')->store('events', 'public');
        }

        $event->fill([
            'title' => $data['title'],
            'location' => $data['location'] ?? null,
            'description' => $data['description'] ?? null,
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'] ?? null,
            'capacity' => $data['capacity'],
        ])->save();

        $event->performers()->sync($data['performers'] ?? []);

        return back()->with('status', 'Event bijgewerkt.');
    }

    public function destroy(Event $event)
    {
        if ($event->image_path) {
            Storage::disk('public')->delete($event->image_path);
        }
        $event->delete();
        return redirect()->route('admin.events.index')->with('status', 'Event verwijderd.');
    }

    public function attendees(Event $event)
    {
        $event->load(['attendees','performers']);
        return view('admin.events.attendees', compact('event'));
    }
}
