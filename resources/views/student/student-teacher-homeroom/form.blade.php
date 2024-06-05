@extends('layouts.main')
@section('container')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($student_teacher_homeroom))
        <form method="POST" action="{{ URL::to('student/student-teacher-homeroom/', $student_teacher_homeroom->id) }}" autocomplete="off">
            @method('put')
    @else
        <form method="POST" action="{{ URL::to('student/student-teacher-homeroom') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="student_id">Student <span class="login-danger">*</span></label>
                <select name="student_id" id="student_id" class="form-control data-select-2">
                    <option value="">Select Student</option>  
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" {{ (isset($student_teacher_homeroom) && $student_teacher_homeroom->student_id == $student->id) ? 'selected' : '' }}>
                                {{ $student->name }}
                            </option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="teacher_homeroom_relationship_id">Teacher Homeroom <span class="login-danger">*</span></label>
                <select name="teacher_homeroom_relationship_id" id="teacher_homeroom_relationship_id" class="form-control data-select-2 @error('teacher_homeroom_relationship_id') is-invalid @enderror">
                    <option value="">Select Teacher Homeroom</option>
                    @foreach ($teacherHomeroomRelationships as $teacherHomeroomRelationship)
                        <option value="{{ $teacherHomeroomRelationship->id }}" {{ (isset($student_teacher_homeroom) && $student_teacher_homeroom->teacher_homeroom_relationship_id == $teacherHomeroomRelationship->id) ? 'selected' : '' }}>
                            {{ $teacherHomeroomRelationship->teacher->name }} - {{ $teacherHomeroomRelationship->classroom->name }}
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
            <div class="student_teacher_homeroom-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ URL::to('student/student-teacher-homeroom/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
