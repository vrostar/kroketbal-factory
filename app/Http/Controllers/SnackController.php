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

    public function index()
    {
        $snacks = Snack::with('user')->get(); // Load user relationship

        return view('snacks.index', ['snacks' => $snacks]);
    }

    public function edit(Snack $snack)
    {
        // Ensure that the currently authenticated user is authorized to edit the snack
        if (auth()->user()->id !== $snack->user_id) {
            abort(403); // Display a "Forbidden" error if the user is not authorized
        }

        return view('snacks.edit', ['snack' => $snack]);
    }

    public function update(Request $request, Snack $snack)
    {
        $this->authorize('update-snack', $snack);

        // Validate and update the snack data
        $snack->update($request->only(['name', 'ingredients', 'description']));

        return redirect()->route('snacks.show', $snack)->with('success', 'Snack updated successfully!');
    }

    public function destroy(Snack $snack)
    {
        $this->authorize('delete-snack', $snack);

        $snack->delete();

        return redirect()->route('snacks.index')->with('success', 'Snack deleted successfully!');
    }


    public function show(Snack $snack)
    {
        return view('snacks.show', ['snack' => $snack]);
    }

}
