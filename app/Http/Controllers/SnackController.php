<?php

namespace App\Http\Controllers;
use App\Models\Snack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SnackController extends Controller
{
    public function create()
    {
        return view('snacks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'ingredients' => 'required|string',
            'description' => 'required|string',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Create a new snack and associate it with the user
        $user->snacks()->create($data);

        return redirect()->route('snacks.create')->with('success', 'Snack created successfully!');
    }
}
