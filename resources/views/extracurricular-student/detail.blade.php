@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb"  style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Parent')
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/extracurricular-student') }}">Extracurricular Participants</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" name="student_name" class="form-control"
                    value="{{ $extracurricular_student->class_name }} - {{ $extracurricular_student->identity_number }} - {{ $extracurricular_student->student_name }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="extracurricular_name">Extracurricular Name</label>
                <input type="text" id="extracurricular_name" name="extracurricular_name" class="form-control"
                    value="{{ $extracurricular_student->extracurricular_name }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control"
                    value="{{ $extracurricular_student->extracurricular_description }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="extracurricular-submit">
                <a href="{{ URL::to('extracurricular-student/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
