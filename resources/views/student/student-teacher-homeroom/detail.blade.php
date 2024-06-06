@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Student Teacher Homeroom Detail</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="student_id">Student</label>
                        <input type="text" id="student_id" name="student_id" class="form-control" value="{{ $studentTeacherHomeroomRelationship->student->identity_number }} - {{ $studentTeacherHomeroomRelationship->student->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="teacher_homeroom_relationship_id">Teacher Homeroom</label>
                        <input type="text" id="teacher_homeroom_relationship_id" name="teacher_homeroom_relationship_id" class="form-control" value="{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->identity_number }} -{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::to('student/student-teacher-homeroom/') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
