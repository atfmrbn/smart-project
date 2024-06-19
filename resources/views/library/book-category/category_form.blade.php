@extends('layouts.main')
@section('title', $title)
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Librarian')
                <li class="breadcrumb-item"><a href="{{ route('librarian.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/book-category') }}">Book Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <h5>{{ isset($category) ? 'Edit' : 'Add' }} Category</h5>
    <br>
    @if (isset($category))
        <form method="POST" action="{{ route('book-category.update', $category->id) }}" autocomplete="off">
            @csrf
            @method('PUT')
        @else
            <form method="POST" action="{{ route('book-category.store') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label for="name">Name <span class="login-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ isset($category) ? $category->name : old('name') }}" required autofocus>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" name="description" id="description" class="form-control"
                    value="{{ isset($category) ? $category->description : old('description') }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ URL::to('book-category') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
    </form>

@endsection
