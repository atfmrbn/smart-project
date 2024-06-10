@extends('layouts.main')
@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (isset($grade))
    <form method="POST" action="{{ route('grade.update', $grade->id) }}" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
    <form method="POST" action="{{ route('grade.store') }}" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="task_type_id">Task Type <span class="login-danger">*</span></label>
                <select name="task_type_id" id="task_type_id" class="form-control data-select-2 @error('task_type_id') is-invalid @enderror">
                    <option value="">Select Task Type</option>
                    @foreach ($taskTypes as $taskType)
                        <option value="{{ $taskType->id }}" {{ (isset($grade) && $grade->task_type_id == $taskType->id) ? 'selected' : '' }}>
                            {{ $taskType->name }}
                        </option>
                    @endforeach
                </select>
                @error('task_type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="student_teacher_homeroom_relationship_id">Student Teacher Homeroom <span class="login-danger">*</span></label>
                <select name="student_teacher_homeroom_relationship_id" id="student_teacher_homeroom_relationship_id" class="form-control data-select-2 @error('student_teacher_homeroom_relationship_id') is-invalid @enderror">
                    <option value="">Pilih Student Teacher Homeroom</option>
                    @foreach ($studentTeacherHomeroomRelationships as $studentTeacherHomeroomRelationship)
                        <option value="{{ $studentTeacherHomeroomRelationship->id }}" {{ (isset($grade) && $grade->student_teacher_homeroom_relationship_id == $studentTeacherHomeroomRelationship->id) ? 'selected' : '' }}>
                            {{ $studentTeacherHomeroomRelationship->student->identity_number }} - {{ $studentTeacherHomeroomRelationship->student->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ optional($studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher)->identity_number }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('student_teacher_homeroom_relationship_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="value">Value <span class="login-danger">*</span></label>
                <input type="text" id="value" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ isset($grade) ? $grade->value : old('value') }}">
                @error('value')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="grade-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('grade.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
