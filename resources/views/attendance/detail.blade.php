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
            <li class="breadcrumb-item"><a href="{{ URL::to('attendance') }}">Attendances</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="student_teacher_homeroom_id">Student Teacher Homeroom</label>
                <input type="text" id="student_teacher_homeroom_id" name="student_teacher_homeroom_id"
                    class="form-control"
                    value="{{ $attendance->studentTeacherHomeroomRelationship->student->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->student->name }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ optional($attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher)->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="attendance_date">Attendance Date</label>
                <input type="text" id="attendance_date" name="attendance_date" class="form-control"
                    value="{{ date('d-m-Y', strtotime($attendance->attendance_date)) }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="note">Note</label>
                <input type="text" id="note" name="note" class="form-control" value="{{ $attendance->note }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ $attendance->status }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="classroom-type-submit">
                <a href="{{ URL::to('attendance/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
