<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $users = User::orderBy('created_at','desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required','string','max:255'],
            'email'    => ['required','email','unique:users,email'],
            'password' => ['required','string','min:8'],
            'is_admin' => ['nullable','boolean'],
        ]);

        $u = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'is_admin'  => $data['is_admin'] ?? false,
        ]);

        return back()->with('status', 'Gebruiker aangemaakt: '.$u->email);
    }

    public function update(Request $request, User $user)
    {
        $request->validate(['is_admin' => 'required|boolean']);
        $user->is_admin = (bool) $request->boolean('is_admin');
        $user->save();
        return back()->with('status', 'Rol bijgewerkt.');
    }
}
