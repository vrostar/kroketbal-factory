<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function giveAdmin(User $user)
    {
        // Authorize admin to give admin status
        $this->authorize('admin');
        // Give user admin role
        $user->role = 'admin';
        $user->save();
        session()->flash('alert', 'Successfully made admin!');

        return redirect(route('users.index'));
    }

    public function removeAdmin(User $user)
    {
        // Authorize admin to delete admin status
        $this->authorize('admin');
        // Give user user role
        $user->role = 'user';
        $user->save();
        session()->flash('alert', 'Removed admin status.');

        return redirect(route('users.index'));
    }

    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function edit()
    {
        $user = auth()->user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Validate the user's input
        $validatedData = $request->validate([
            'id' => 'required|exists:users',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Find user by ID
        $user = User::find($validatedData['id']);

        // Update user data by user's input
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        return redirect(route('users.edit', $user->id))->with('alert', 'Profile updated successfully');
    }

}

