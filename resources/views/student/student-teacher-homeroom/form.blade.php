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
            @elseif (auth()->user()->role == 'Parent')
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/student/student-teacher-homeroom') }}">Student Teacher Homerooms</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($studentTeacherHomeroomRelationship))
        <form method="POST" action="{{ route('student-teacher-homeroom.update', $studentTeacherHomeroomRelationship->id) }}"
            autocomplete="off">
            @method('PUT')
        @else
            <form method="POST" action="{{ route('student-teacher-homeroom.store') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-sm-12 col-lg-6">
            <div class="form-group local-forms">
                <label for="student_id">Student <span class="login-danger">*</span></label>
                <select name="student_id" id="student_id" class="form-control data-select-2">
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ isset($studentTeacherHomeroomRelationship) && $studentTeacherHomeroomRelationship->student_id == $student->id ? 'selected' : '' }}>
                            {{ $student->identity_number }} - {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-12 col-lg-6">
            <div class="form-group local-forms">
                <label for="teacher_homeroom_relationship_id">Teacher Homeroom <span class="login-danger">*</span></label>
                <select name="teacher_homeroom_relationship_id" id="teacher_homeroom_relationship_id"
                    class="form-control data-select-2 @error('teacher_homeroom_relationship_id') is-invalid @enderror">
                    <option value="">Select Teacher Homeroom</option>
                    @foreach ($teacherHomeroomRelationships as $teacherHomeroomRelationship)
                        <option value="{{ $teacherHomeroomRelationship->id }}"
                            {{ isset($studentTeacherHomeroomRelationship) && $studentTeacherHomeroomRelationship->teacher_homeroom_relationship_id == $teacherHomeroomRelationship->id ? 'selected' : '' }}>
                            {{ $teacherHomeroomRelationship->classroom->name }} -
                            {{ $teacherHomeroomRelationship->teacher->identity_number }} -
                            {{ $teacherHomeroomRelationship->teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_homeroom_relationship_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="studentTeacherHomeroomRelationship-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('student-teacher-homeroom.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
