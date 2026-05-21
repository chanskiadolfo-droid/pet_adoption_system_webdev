@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Pet List</h2>

    <form method="GET" action="{{ route('pets.index') }}">
        <input type="text" name="search" placeholder="Search pets..." value="{{ $search }}">
        <button class="btn" type="submit">Search</button>
        <a class="btn btn-light" href="{{ route('pets.index') }}">Reset</a>

        @if(in_array(auth()->user()->role, ['admin', 'staff']))
            <a class="btn" href="{{ route('pets.create') }}">Add Pet</a>
        @endif
    </form>

    <table>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @forelse($pets as $pet)
        <tr>
            <td>{{ $pet->name }}</td>
            <td>{{ $pet->type }}</td>
            <td>{{ $pet->breed ?? 'N/A' }}</td>
            <td>{{ $pet->age ?? 'N/A' }}</td>
            <td>{{ $pet->gender }}</td>
            <td>
                <span class="badge {{ $pet->status }}">{{ ucfirst($pet->status) }}</span>
            </td>
            <td>
                <div class="actions">
                    <a class="btn btn-light" href="{{ route('pets.show', $pet) }}">View</a>

                    @if(in_array(auth()->user()->role, ['admin', 'staff']))
                        <a class="btn btn-warning" href="{{ route('pets.edit', $pet) }}">Edit</a>
                    @endif

                    @if(auth()->user()->role === 'adopter' && $pet->status === 'available')
                        <a class="btn" href="{{ route('adoptions.create', $pet) }}">Adopt</a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('pets.destroy', $pet) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Delete pet?')">Delete</button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">No pets found.</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection
