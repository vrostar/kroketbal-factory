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
        $user->role = 'admin';
        $user->save();
        session()->flash('alert', 'User successfully made administrator.');

        return redirect(route('users.index'));
    }

    public function removeAdmin(User $user)
    {
        $user->role = 'user';
        $user->save();
        session()->flash('alert', 'Removed admin status.');

        return redirect(route('users.index'));
    }

    public function index(){
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
        $validated = $this->validate($request,
            [
                'id' => 'bail|required|exists:users',
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);
        $user = User::find($validated['id']);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();
        return redirect(route('users.edit', $user->id));
    }
}

