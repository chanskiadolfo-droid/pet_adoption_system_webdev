@extends('layouts.app')

@section('content')
<div class="panel" style="max-width: 430px; margin: auto;">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button class="btn" type="submit">Login</button>
    </form>

    <p><strong>Admin:</strong> admin@example.com / password</p>
    <p><strong>Staff:</strong> staff@example.com / password</p>
    <p><strong>Adopter:</strong> adopter@example.com / password</p>
</div>
@endsection
