@extends('layouts.app')

@section('title', 'Add Parent Information')

@section('content')
<div class="container">
    <h2>Add Parent Information</h2>
    <form method="POST" action="{{ route('parents.store') }}">
        @csrf
        <div class="form-group">
            <label for="user_id">User ID</label>
            <input type="number" name="user_id" id="user_id" class="form-control" value="{{ old('user_id') }}">
            @error('user_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="parent_name">Parent Name</label>
            <input type="text" name="parent_name" id="parent_name" class="form-control" value="{{ old('parent_name') }}">
            @error('parent_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="parent_email">Parent Email</label>
            <input type="email" name="parent_email" id="parent_email" class="form-control" value="{{ old('parent_email') }}">
            @error('parent_email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Add Parent</button>
    </form>
</div>
@endsection
