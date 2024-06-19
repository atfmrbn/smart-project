@extends('layouts.main')
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
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/teacher/teacher-classroom') }}">Teacher
                    Classrooms</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($teacher_classroom))
        <form method="POST" action="{{ route('teacher-classroom.update', $teacher_classroom->id) }}" autocomplete="off">
            @method('PUT')
        @else
            <form method="POST" action="{{ route('teacher-classroom.store') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="teacher_homeroom_relationship_id">Classroom <span class="login-danger">*</span></label>
                <select name="teacher_homeroom_relationship_id" id="teacher_homeroom_relationship_id"
                    class="form-control data-select-2 @error('teacher_homeroom_relationship_id') is-invalid @enderror">
                    <option value="">Select Classroom</option>
                    @foreach ($teacherHomeroomRelationships as $teacherHomeroomRelationship)
                        <option value="{{ $teacherHomeroomRelationship->id }}"
                            {{ isset($teacher_classroom) && $teacher_classroom->teacher_homeroom_relationship_id == $teacherHomeroomRelationship->id ? 'selected' : '' }}>
                            {{ $teacherHomeroomRelationship->classroom->name }} -
                            {{ $teacherHomeroomRelationship->classroom->classroomType->name }}
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

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="teacher_subject_relationship_id">Teacher Subject <span class="login-danger">*</span></label>
                <select name="teacher_subject_relationship_id" id="teacher_subject_relationship_id"
                    class="form-control data-select-2 @error('teacher_subject_relationship_id') is-invalid @enderror">
                    <option value="">Select Teacher Subject</option>
                    @foreach ($teacherSubjectRelationships as $teacherSubjectRelationship)
                        <option value="{{ $teacherSubjectRelationship->id }}"
                            {{ isset($teacher_classroom) && $teacher_classroom->teacher_subject_relationship_id == $teacherSubjectRelationship->id ? 'selected' : '' }}>
                            {{ $teacherSubjectRelationship->teacher->identity_number }} -
                            {{ $teacherSubjectRelationship->teacher->name }} -
                            {{ $teacherSubjectRelationship->subject->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_subject_relationship_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>



        <div class="col-12">
            <div class="teacher_classroom-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('teacher-classroom.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
