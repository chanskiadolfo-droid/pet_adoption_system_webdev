@extends('layouts.app')

@section('content')
<div class="panel">
    <h2>Edit Pet</h2>

    <form method="POST" action="{{ route('pets.update', $pet) }}">
        @csrf
        @method('PUT')
        @include('pets.form')
        <button class="btn" type="submit">Update</button>
        <a class="btn btn-light" href="{{ route('pets.index') }}">Cancel</a>
    </form>
</div>
@endsection
