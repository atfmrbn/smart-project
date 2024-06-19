@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('classroom/classroom-type/') }}">Classroom Types</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($classroom_type))
        <form method="POST" action="{{ URL::to('classroom/classroom-type/' . $classroom_type->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('classroom/classroom-type') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="name">Name of Classroom Types <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($classroom_type) ? $classroom_type->name : old('name') }}" autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" id="description" name="description"
                    class="form-control @error('description')is-invalid @enderror"
                    value="{{ isset($classroom_type) ? $classroom_type->description : old('description') }}">
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="student-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ URL::to('classroom/classroom-type/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
