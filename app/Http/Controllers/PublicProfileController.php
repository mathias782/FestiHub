<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $users = \App\Models\User::query()
            ->when($q, fn ($query) => $query->where(function ($qq) use ($q) {
                $qq->where('username', 'like', "%{$q}%")
                ->orWhere('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%");
            }))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('users.index', compact('users', 'q'));
    }

    public function show(User $user)
    {
        $user->load([
            'performerEvents' => fn ($q) => $q->orderBy('starts_at'),
            'events'          => fn ($q) => $q->orderBy('starts_at'),
        ]);

        return view('users.show', compact('user'));
    }
}
