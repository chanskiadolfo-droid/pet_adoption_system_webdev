@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>User Management</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Role</label>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="staff">Staff</option>
            <option value="adopter">Adopter</option>
        </select>

        <button class="btn" type="submit">Add User</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>

            <td>
                <form id="update-user-{{ $user->id }}" method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="name" value="{{ $user->name }}" required>
                </form>
            </td>

            <td>
                <input form="update-user-{{ $user->id }}" type="email" name="email" value="{{ $user->email }}" required>
            </td>

            <td>
                <select form="update-user-{{ $user->id }}" name="role" required>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                    <option value="staff" @selected($user->role === 'staff')>Staff</option>
                    <option value="adopter" @selected($user->role === 'adopter')>Adopter</option>
                </select>
            </td>

            <td>
                <div class="actions">
                    <button form="update-user-{{ $user->id }}" class="btn" type="submit">
                        Update
                    </button>

                    @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('users.destroy', $user) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Delete this user?')">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
