@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Add Pet</h2>

    <form method="POST" action="{{ route('pets.store') }}">
        @csrf
        @include('pets.form')
        <button class="btn" type="submit">Save</button>
        <a class="btn btn-light" href="{{ route('pets.index') }}">Cancel</a>
    </form>
</div>
@endsection
