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
            @elseif (auth()->user()->role == 'Parent')
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/student/student-teacher-homeroom') }}">Student Teacher
                    Homerooms</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="student_id">Student</label>
                <input type="text" id="student_id" name="student_id" class="form-control"
                    value="{{ $studentTeacherHomeroomRelationship->student->identity_number }} - {{ $studentTeacherHomeroomRelationship->student->name }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="teacher_homeroom_relationship_id">Teacher Homeroom</label>
                <input type="text" id="teacher_homeroom_relationship_id" name="teacher_homeroom_relationship_id"
                    class="form-control"
                    value="{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->identity_number }} -{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="student-submit">
                <a href="{{ URL::to('student/student-teacher-homeroom/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
