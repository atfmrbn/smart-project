@extends('layouts.main')
@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (isset($teacher_classroom))
    <form method="POST" action="{{ route('teacher-classroom.update', $teacher_classroom->id) }}" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
    <form method="POST" action="{{ route('teacher-classroom.store') }}" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="classroom_id">Classroom <span class="login-danger">*</span></label>
                <select name="classroom_id" id="classroom_id" class="form-control data-select-2 @error('classroom_id') is-invalid @enderror">
                    <option value="">Select Classroom</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ (isset($teacher_classroom) && $teacher_classroom->classroom_id == $classroom->id) ? 'selected' : '' }}>
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

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="teacher_subject_relationship_id">Teacher Subject <span class="login-danger">*</span></label>
                <select name="teacher_subject_relationship_id" id="teacher_subject_relationship_id" class="form-control data-select-2 @error('teacher_subject_relationship_id') is-invalid @enderror">
                    <option value="">Select Teacher Subject</option>
                    @foreach ($teacherSubjectRelationships as $teacherSubjectRelationship)
                        <option value="{{ $teacherSubjectRelationship->id }}" {{ (isset($teacher_classroom) && $teacher_classroom->teacher_subject_relationship_id == $teacherSubjectRelationship->id) ? 'selected' : '' }}>
                            {{ $teacherSubjectRelationship->teacher->identity_number }} - {{ $teacherSubjectRelationship->teacher->name }} - {{ $teacherSubjectRelationship->subject->name }}
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

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="schedule_day">Teacher Schedule Day <span class="login-danger">*</span></label>
                <select name="schedule_day" id="schedule_day" class="form-control data-select-2 @error('schedule_day') is-invalid @enderror">
                    <option value="">Select Schedule Day</option>
                    <option value="Senin" {{ isset($teacher_classroom) && $teacher_classroom->schedule_day == "Senin" ? 'selected' : '' }}>Senin</option>
                    <option value="Selasa" {{ isset($teacher_classroom) && $teacher_classroom->schedule_day == "Selasa" ? 'selected' : '' }}>Selasa</option>
                    <option value="Rabu" {{ isset($teacher_classroom) && $teacher_classroom->schedule_day == "Rabu" ? 'selected' : '' }}>Rabu</option>
                    <option value="Kamis" {{ isset($teacher_classroom) && $teacher_classroom->schedule_day == "Kamis" ? 'selected' : '' }}>Kamis</option>
                    <option value="Jumat" {{ isset($teacher_classroom) && $teacher_classroom->schedule_day == "Jumat" ? 'selected' : '' }}>Jumat</option>
                    <option value="Sabtu" {{ isset($teacher_classroom) && $teacher_classroom->schedule_day == "Sabtu" ? 'selected' : '' }}>Sabtu</option>
                </select>
                @error('schedule_day')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="schedule_time_start">Teacher Schedule Time Start <span class="login-danger">*</span></label>
                <input class="form-control @error('schedule_time_start') is-invalid @enderror" type="time" name="schedule_time_start" value="{{ isset($teacher_classroom) ? $teacher_classroom->schedule_time_start : '' }}" />
                @error('schedule_time_start')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="schedule_time_end">Teacher Schedule Time End <span class="login-danger">*</span></label>
                <input class="form-control @error('schedule_time_end') is-invalid @enderror" type="time" name="schedule_time_end" value="{{ isset($teacher_classroom) ? $teacher_classroom->schedule_time_end : '' }}" />
                @error('schedule_time_end')
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
