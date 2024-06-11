@extends('layouts.main')

@section('container')
<div class="container">
    <h1>Dashboard</h1>
    <p>Selamat datang, {{ $user->name }}!</p>

    <h2>Parent Information</h2>
    @if($parents->isEmpty())
        <p>No parent information available.</p>
    @else
        <ul>
            @foreach($parents as $parent)
                <li>
                    <strong>Name:</strong> {{ $parent->parent_name }}
                    <strong>Email:</strong> {{ $parent->parent_email }}
                </li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('parents.dashboard') }}" class="btn btn-primary">Add Parent Information</a>
</div>
@endsection
