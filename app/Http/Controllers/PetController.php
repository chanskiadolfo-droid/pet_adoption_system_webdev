<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    private function canManagePets()
    {
        return in_array(auth()->user()->role, ['admin', 'staff']);
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $pets = Pet::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%")
                ->orWhere('breed', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        })->latest()->get();

        return view('pets.index', compact('pets', 'search'));
    }

    public function create()
    {
        abort_unless($this->canManagePets(), 403);
        return view('pets.create');
    }

    public function store(Request $request)
    {
        abort_unless($this->canManagePets(), 403);

        Pet::create($request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'breed' => 'nullable|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:available,adopted',
        ]));

        return redirect()->route('pets.index')->with('success', 'Pet added successfully.');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        abort_unless($this->canManagePets(), 403);
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        abort_unless($this->canManagePets(), 403);

        $pet->update($request->validate([
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'breed' => 'nullable|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'required',
            'description' => 'nullable',
            'status' => 'required|in:available,adopted',
        ]));

        return redirect()->route('pets.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        $pet->delete();

        return redirect()->route('pets.index')->with('success', 'Pet deleted successfully.');
    }
}
