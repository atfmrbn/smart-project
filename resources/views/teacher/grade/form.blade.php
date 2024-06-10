@extends('layouts.main')
@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (isset($grade))
    <form method="POST" action="{{ route('teacher-grade.update', $grade->id) }}" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
@else
    <form method="POST" action="{{ route('teacher-grade.store') }}" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="taskType_id">Task Type <span class="login-danger">*</span></label>
                <select name="taskType_id" id="taskType_id" class="form-control data-select-2 @error('taskType_id') is-invalid @enderror">
                    <option value="">Select Task Type</option>
                    @foreach ($taskTypes as $taskType)
                        <option value="{{ $taskType->id }}" {{ (isset($grade) && $grade->taskType_id == $taskType->id) ? 'selected' : '' }}>
                            {{ $taskType->name }} - {{ $taskType->name }}
                        </option>
                    @endforeach
                </select>
                @error('taskType_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="studentTeacherHomeroom_id">Student Teacher Homeroom <span class="login-danger">*</span></label>
                <select name="studentTeacherHomeroom_id" id="studentTeacherHomeroom_id" class="form-control data-select-2 @error('studentTeacherHomeroom_id') is-invalid @enderror">
                    <option value="">Select Student Teacher Homeroom</option>
                    @foreach ($studentTeacherHomerooms as $studentTeacherHomeroom)
                        <option value="{{ $studentTeacherHomeroom->id }}" {{ (isset($grade) && $grade->studentTeacherHomeroom_id == $studentTeacherHomeroom->id) ? 'selected' : '' }}>
                            {{ $studentTeacherHomeroom->name }} - {{ $studentTeacherHomeroom->name }}
                        </option>
                    @endforeach
                </select>
                @error('studentTeacherHomeroom_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="value">Value <span class="login-danger">*</span></label>
                <input type="text" id="value" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ isset($subject) ? $subject->value : old('value') }}">
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
                <a href="{{ route('teacher-grade.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
