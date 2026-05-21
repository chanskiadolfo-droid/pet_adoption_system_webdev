@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>{{ $pet->name }}</h2>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px;">
        <div>
            <p><strong>Pet Name:</strong> {{ $pet->name }}</p>
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

            <p><strong>Description:</strong></p>
            <p>{{ $pet->description ?? 'No description provided.' }}</p>
        </div>

        <div>
            <div style="
                background: #ecfdf5;
                border: 1px solid #bbf7d0;
                border-radius: 14px;
                padding: 20px;
            ">
                <h3>Adoption Information</h3>

                @if($pet->status === 'available')
                    <p>This pet is still available for adoption.</p>

                    @if(auth()->user()->role === 'adopter')
                        <a class="btn" href="{{ route('adoptions.create', $pet) }}">
                            Submit Adoption Request
                        </a>
                    @else
                        <p>Only adopters can submit adoption requests.</p>
                    @endif
                @else
                    <p>This pet has already been adopted.</p>
                @endif
            </div>
        </div>
    </div>

    <br>

    <div class="actions">
        @if(in_array(auth()->user()->role, ['admin', 'staff']))
            <a class="btn btn-warning" href="{{ route('pets.edit', $pet) }}">
                Edit Pet
            </a>
        @endif

        <a class="btn btn-light" href="{{ route('pets.index') }}">
            Back to Pet List
        </a>
    </div>
</div>
@endsection
