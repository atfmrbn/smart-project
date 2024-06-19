@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/teacher/grade-detail') }}">Grade Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($gradeDetail))
        <form method="POST" action="{{ route('grade-detail.update', $gradeDetail->id) }}" autocomplete="off">
            @method('PUT')
        @else
            <form method="POST" action="{{ route('grade-detail.store') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="grade_id"> Grade <span class="login-danger">*</span></label>
                <select name="grade_id" id="grade_id"
                    class="form-control data-select-2 @error('grade_id') is-invalid @enderror">
                    <option value="">Select Grade</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}" @if (isset($gradeDetail) && $gradeDetail->grade_id == $grade->id) selected @endif>
                            {{ $grade->taskType->name ?? '' }} -
                            {{ $grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name ?? '' }}
                            -
                            {{ $grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name ?? '' }}
                            -
                            {{ $grade->teacherClassroomRelationship->teacherSubjectRelationship->teacher->name ?? '' }} -
                            {{ $grade->teacherClassroomRelationship->teacherSubjectRelationship->subject->name ?? '' }}
                        </option>
                    @endforeach
                </select>
                @error('grade_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="student_id">Student <span class="login-danger">*</span></label>
                <select name="student_id" id="student_id"
                    class="form-control data-select-2 @error('student_id') is-invalid @enderror">
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" @if (isset($gradeDetail) && $gradeDetail->student_id == $student->id) selected @endif>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="value">Value <span class="login-danger">*</span></label>
                <input type="text" id="value" name="value"
                    class="form-control @error('value') is-invalid @enderror"
                    value="{{ isset($gradeDetail) ? $gradeDetail->value : old('value') }}">
                @error('value')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="gradeDetail-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('grade-detail.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
