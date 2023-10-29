<?php

namespace App\Http\Controllers;

use App\Models\Snack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SnackController extends Controller
{
    public function create()
    {
        return view('snacks.create');
    }

    public function store(Request $request)
    {
        // Validate the snack data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'ingredients' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        $user = auth()->user();

        // Create new snack and link it to the user
        $user->snacks()->create($validatedData);

        return redirect()->route('snacks.index')->with('success', 'Snack created successfully!');
    }


    public function index(Request $request)
    {
        // Input for search
        $search = $request->input('search');
        // Input for filtering by type
        $type = $request->input('type');
        // Retrieve snacks and their relationship with the user that made it
        $snacks = Snack::with('user')
            ->when($search, function ($query) use ($search) {
                // Search by search input when query is provided
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%');
            })
            ->when($type, function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->get();

        return view('snacks.index', ['snacks' => $snacks, 'search' => $search]);
    }


    public function edit(Snack $snack)
    {
        // Check if current user has made snack, if so allow them to edit
        if (auth()->user()->id !== $snack->user_id) {
            abort(403); // Display "Forbidden" error if the user did not create the snack
        }

        return view('snacks.edit', ['snack' => $snack]);
    }

    public function update(Request $request, Snack $snack)
    {
        // Use update-snack gate to check if user ID matched snack ID
        $this->authorize('update-snack', $snack);

        // Once authorized allow user to edit snack
        $snack->update($request->only(['name', 'ingredients', 'description', 'type']));

        return redirect()->route('snacks.show', $snack)->with('success', 'Snack updated successfully!');
    }

    public function destroy(Snack $snack)
    {
        // Only allow admins or snack owners to delete the current post
        if (Gate::allows('admin') || $snack->user_id === auth()->id()) {
            $snack->delete();
            return redirect()->route('snacks.index')->with('success', 'Snack deleted successfully');
        } else {
            return redirect()->route('snacks.index')->with('error', 'You are not authorized to delete this snack');
        }

    }


    public function show(Snack $snack)
    {
        return view('snacks.show', ['snack' => $snack]);
    }

}
