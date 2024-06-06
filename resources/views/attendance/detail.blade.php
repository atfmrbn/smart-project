@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Attendance Detail</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="student_teacher_homeroom_id">student Teacher Homeroom</label>
                        <input type="text" id="student_teacher_homeroom_id" name="student_teacher_homeroom_id" class="form-control" value="{{ $attendance->studentTeacherHomeroomRelationship->student->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->student->name }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ optional($attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher)->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="attendance_date">Attendance Date</label>
                        <input type="text" id="attendance_date" name="attendance_date" class="form-control" value="{{ date('d-m-Y', strtotime($attendance->attendance_date)) }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="note">Note</label>
                        <input type="text" id="note" name="note" class="form-control" value="{{ $attendance->note }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="status">status</label>
                        <input type="text" id="status" name="status" class="form-control" value="{{ $attendance->status }}" readonly>
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::to('attendance/') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
