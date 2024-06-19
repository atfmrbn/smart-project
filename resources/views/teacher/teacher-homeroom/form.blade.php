@extends('layouts.main')
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
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/teacher/teacher-homeroom') }}">Teacher
                    Homerooms</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($teacher_homeroom))
        <form method="POST" action="{{ route('teacher-homeroom.update', $teacher_homeroom->id) }}" autocomplete="off">
            @method('put')
        @else
            <form method="POST" action="{{ route('teacher-homeroom.store') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="teacher_id">Teacher <span class="login-danger">*</span></label>
                <select name="teacher_id" id="teacher_id" class="form-control data-select-2">
                    <option value="">Select Teacher</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            {{ isset($teacher_homeroom) && $teacher_homeroom->teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="classroom_id">Classroom <span class="login-danger">*</span></label>
                <select name="classroom_id" id="classroom_id" class="form-control data-select-2">
                    <option value="">Select Classroom</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}"
                            {{ isset($teacher_homeroom) && $teacher_homeroom->teacher_id == $teacher->id ? 'selected' : '' }}>
                            {{ $classroom->classroomType->name }} - {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>

                @error('classroom_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="teacher_homeroom-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('teacher-homeroom.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
