@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Submit Adoption Request</h2>

    <div style="
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        border-radius: 14px;
        padding: 18px;
        margin-bottom: 20px;
    ">
        <h3>{{ $pet->name }}</h3>

        <p><strong>Type:</strong> {{ $pet->type }}</p>
        <p><strong>Breed:</strong> {{ $pet->breed ?? 'N/A' }}</p>
        <p><strong>Age:</strong> {{ $pet->age ?? 'N/A' }}</p>
        <p><strong>Gender:</strong> {{ $pet->gender }}</p>

        <p>
            <strong>Status:</strong>
            <span class="badge {{ $pet->status }}">
                {{ ucfirst($pet->status) }}
            </span>
        </p>
    </div>

    <form method="POST" action="{{ route('adoptions.store', $pet) }}">
        @csrf

        <label>Adopter Name</label>
        <input
            type="text"
            name="adopter_name"
            value="{{ old('adopter_name', auth()->user()->name) }}"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', auth()->user()->email) }}"
            required
        >

        <label>Contact Number</label>
        <input
            type="text"
            name="contact_number"
            value="{{ old('contact_number') }}"
            required
        >

        <label>Address</label>
        <textarea name="address" required>{{ old('address') }}</textarea>

        <label>Reason for Adoption</label>
        <textarea name="reason">{{ old('reason') }}</textarea>

        <button class="btn" type="submit">
            Submit Request
        </button>

        <a class="btn btn-light" href="{{ route('pets.show', $pet) }}">
            Cancel
        </a>
    </form>
</div>
@endsection
