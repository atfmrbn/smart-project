@extends('layouts.main')
@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (isset($grade))
    <form method="POST" action="{{ route('grade.update', $grade->id) }}" autocomplete="off" >
    @method('PUT')
@else
    <form method="POST" action="{{ route('grade.store') }}" autocomplete="off">
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
                <label for="teacher_classroom_relationship_id">Teacher Classroom <span class="login-danger">*</span></label>
                <select name="teacher_classroom_relationship_id" id="teacher_classroom_relationship_id" class="form-control data-select-2 @error('teacher_classroom_relationship_id') is-invalid @enderror">
                    <option value="">Pilih Teacher Classroom</option>
                    @foreach ($teacherClassroomRelationships as $teacherClassroomRelationship)
                        <option value="{{ $teacherClassroomRelationship->id }}" {{ (isset($grade) && $grade->teacher_classroom_relationship_id == $teacherClassroomRelationship->id) ? 'selected' : '' }}>
                            {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }} -
                            {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $teacherClassroomRelationship->TeacherSubjectRelationship->teacher->name }}-{{ $teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
                        </option>
                    @endforeach
                </select>

                @error('teacher_classroom_relationship_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="percentage">Percetage <span class="login-danger">*</span></label>
                <input type="text" id="percentage" name="percentage" class="form-control @error('percentage') is-invalid @enderror" value="{{ isset($grade) ? $grade->percentage : old('percentage') }}">
                @error('percentage')
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
