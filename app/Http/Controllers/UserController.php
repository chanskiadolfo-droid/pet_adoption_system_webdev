<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function adminOnly()
    {
        abort_unless(auth()->user()->role === 'admin', 403);
    }

    public function index()
    {
        $this->adminOnly();

        $users = User::orderBy('id', 'asc')->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return redirect()->route('users.index');
    }

    public function store(Request $request)
    {
        $this->adminOnly();

        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,staff,adopter',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    public function edit(User $user)
    {
        return redirect()->route('users.index');
    }

    public function update(Request $request, User $user)
    {
        $this->adminOnly();

        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,staff,adopter',
        ]);

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->adminOnly();

        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'user' => 'You cannot delete your own account.',
            ]);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
