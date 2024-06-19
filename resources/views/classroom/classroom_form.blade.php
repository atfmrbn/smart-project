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
            <li class="breadcrumb-item"><a href="{{ URL::to('classroom/') }}">Classrooms</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (isset($classroom))
        <form method="POST" action="{{ URL::to('classroom/' . $classroom->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('classroom') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-6 col-sm-12">
            <div class="form-group">
                <label for="classroomType_id">Classroom Type ID</label>
                <select class="form-control data-select-2" name="classroom_type_id" id="classroom_type_id">
                    @foreach ($classroom_types as $classroom_type)
                        <option value="{{ $classroom_type->id }}"
                            {{ isset($classroom) ? ($classroom->classroom_type_id === $classroom_type->id ? ' selected' : '') : '' }}>
                            {{ $classroom_type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-6 col-sm-12">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($classroom) ? $classroom->name : old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="student-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ URL::to('classroom/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
        </form>
    </div>
@endsection
