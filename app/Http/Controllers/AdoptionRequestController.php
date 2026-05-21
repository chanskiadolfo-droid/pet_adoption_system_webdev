<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\AdoptionRequest;
use Illuminate\Http\Request;

class AdoptionRequestController extends Controller
{
    private function canReview()
    {
        return in_array(auth()->user()->role, ['admin', 'staff']);
    }

    public function index()
    {
        if ($this->canReview()) {
            $adoptions = AdoptionRequest::with(['pet', 'user'])->latest()->get();
        } else {
            $adoptions = AdoptionRequest::with('pet')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('adoptions.index', compact('adoptions'));
    }

    public function create(Pet $pet)
    {
        abort_unless(auth()->user()->role === 'adopter', 403);

        if ($pet->status === 'adopted') {
            return redirect()->route('pets.index')->with('success', 'This pet is already adopted.');
        }

        return view('adoptions.create', compact('pet'));
    }

    public function store(Request $request, Pet $pet)
    {
        abort_unless(auth()->user()->role === 'adopter', 403);

        $data = $request->validate([
            'adopter_name' => 'required|max:255',
            'email' => 'required|email',
            'contact_number' => 'required|max:50',
            'address' => 'required',
            'reason' => 'nullable',
        ]);

        $data['pet_id'] = $pet->id;
        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        AdoptionRequest::create($data);

        return redirect()->route('adoptions.index')->with('success', 'Adoption request submitted.');
    }

    public function approve(AdoptionRequest $adoptionRequest)
    {
        abort_unless($this->canReview(), 403);

        $adoptionRequest->update(['status' => 'approved']);
        $adoptionRequest->pet->update(['status' => 'adopted']);

        return back()->with('success', 'Adoption request approved.');
    }

    public function reject(AdoptionRequest $adoptionRequest)
    {
        abort_unless($this->canReview(), 403);

        $adoptionRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Adoption request rejected.');
    }

    public function destroy(AdoptionRequest $adoptionRequest)
    {
        abort_unless(auth()->user()->role === 'admin', 403);

        if ($adoptionRequest->status === 'approved') {
            $adoptionRequest->pet->update(['status' => 'available']);
        }

        $adoptionRequest->delete();

        return back()->with('success', 'Adoption request deleted.');
    }
}
