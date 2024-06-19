@extends('layouts.main')
@section('title', $title)
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Librarian')
                <li class="breadcrumb-item"><a href="{{ route('librarian.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/book') }}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <h5>{{ isset($book) ? 'Edit' : 'Add' }} Book</h5>
    <br>
    @if (isset($book))
        <form method="POST" action="{{ route('book.update', $book->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
        @else
            <form method="POST" action="{{ route('book.store') }}" autocomplete="off" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="row">
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="title">Book Name <span class="login-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ isset($book) ? $book->title : old('name') }}" autofocus>
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="category_id">Category <span class="login-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-control data-select-2">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ isset($book) && $book->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="author">Author <span class="login-danger">*</span></label>
                <input type="text" name="author" id="author" class="form-control"
                    value="{{ isset($book) ? $book->author : old('name') }}">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="publisher">Publisher <span class="login-danger">*</span></label>
                <input type="text" name="publisher" id="publisher" class="form-control"
                    value="{{ isset($book) ? $book->publisher : old('name') }}">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="published_year">Published Year <span class="login-danger">*</span></label>
                <input type="text" name="published_year" id="published_year" class="form-control"
                    value="{{ isset($book) ? $book->published_year : old('name') }}">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="isbn">ISBN <span class="login-danger">*</span></label>
                <input type="text" name="isbn" id="isbn" class="form-control"
                    value="{{ isset($book) ? $book->isbn : old('name') }}">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="status">Status <span class="login-danger">*</span></label>
                <select name="status" id="status" class="form-control select2" required>
                    <option value="">Select Status</option>
                    <option value="available" {{ isset($book) && $book->status == 'available' ? 'selected' : '' }}>
                        Available</option>
                    <option value="unavailable" {{ isset($book) && $book->status == 'unavailable' ? 'selected' : '' }}>
                        Unavailable</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-8">
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" name="description" id="description" class="form-control"
                    value="{{ isset($book) ? $book->description : old('description') }}">
            </div>
        </div>

        {{-- <div class="col-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" 
                value="{{ isset($book) ? $book->image : old('image') }}">
            </div>
        </div> --}}

        <div class="col-12">
            <div class="student-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ URL::to('book') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
