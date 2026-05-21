@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Adoption Requests</h2>

    <a class="btn btn-light" href="{{ route('pets.index') }}">Back to Pets</a>

    <table>
        <tr>
            <th>Pet</th>
            <th>Adopter</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>

        @forelse($adoptions as $adoption)
        <tr>
            <td>{{ $adoption->pet->name ?? 'Deleted Pet' }}</td>
            <td>{{ $adoption->adopter_name }}</td>
            <td>{{ $adoption->email }}</td>
            <td>{{ $adoption->contact_number }}</td>
            <td>{{ $adoption->address }}</td>

            <td>
                <span class="badge {{ $adoption->status }}">
                    {{ ucfirst($adoption->status) }}
                </span>
            </td>

            <td>{{ $adoption->created_at->format('M d, Y') }}</td>

            <td>
                <div class="actions">
                    @if(in_array(auth()->user()->role, ['admin', 'staff']) && $adoption->status === 'pending')
                        <form method="POST" action="{{ route('adoptions.approve', $adoption) }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn" onclick="return confirm('Approve this adoption request?')">
                                Approve
                            </button>
                        </form>

                        <form method="POST" action="{{ route('adoptions.reject', $adoption) }}">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-warning" onclick="return confirm('Reject this adoption request?')">
                                Reject
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <form method="POST" action="{{ route('adoptions.destroy', $adoption) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Delete this adoption request?')">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8">No adoption requests found.</td>
        </tr>
        @endforelse
    </table>
</div>
@endsection
