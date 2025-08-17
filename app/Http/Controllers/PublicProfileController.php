<?php

namespace App\Http\Controllers;

use App\Models\User;

class PublicProfileController extends Controller
{
    public function show(User $user)
    {
        /*$user->load(['performances' => function ($q) {
            $q->where('starts_at', '>=', now())->orderBy('starts_at');
        }]);*/

        return view('users.show', compact('user'));
    }
}
