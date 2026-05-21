@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Dashboard</h2>

    <div class="cards">
        <div class="card">
            <h3>{{ $stats['pets'] }}</h3>
            <p>Total Pets</p>
        </div>

        <div class="card">
            <h3>{{ $stats['available'] }}</h3>
            <p>Available Pets</p>
        </div>

        <div class="card">
            <h3>{{ $stats['adopted'] }}</h3>
            <p>Adopted Pets</p>
        </div>

        <div class="card">
            <h3>{{ $stats['requests'] }}</h3>
            <p>Adoption Requests</p>
        </div>

        @if(auth()->user()->role === 'admin')
            <div class="card">
                <h3>{{ $stats['users'] }}</h3>
                <p>Total Users</p>
            </div>
        @endif
    </div>
</div>
@endsection
