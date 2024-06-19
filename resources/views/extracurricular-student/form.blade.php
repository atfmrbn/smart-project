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
            @elseif (auth()->user()->role == 'Parent')
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/extracurricular-student') }}">Extracurricular Participants</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($extracurricular_student))
        <form method="POST" action="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}"
            autocomplete="off">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('extracurricular-student') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-6">
            @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                <div class="form-group local-forms">
                    <label for="student_id">Student Name <span class="login-danger">*</span></label>
                    <select class="form-control data-select-2" name="student_id" id="student_id">
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}"
                                {{ isset($extracurricular_student) ? ($extracurricular_student->student_id === $student->id ? ' selected' : '') : (old('student_id') == $student->id ? ' selected' : '') }}>
                                {{ $student->class_name }} - {{ $student->identity_number }} - {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('student_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @else
                <input type="hidden" name="student_id" value="{{ auth()->user()->id }}">
            @endif

            <div class="form-group local-forms">
                <label for="extracurricular_id">Extracurricular Name <span class="login-danger">*</span></label>
                <select class="form-control data-select-2" name="extracurricular_id" id="extracurricular_id"
                    onchange="updateDescription()">
                    <option value="">Select Extracurricular</option>
                    @foreach ($extracurriculars as $extracurricular)
                        <option value="{{ $extracurricular->id }}"
                            {{ isset($extracurricular_student) ? ($extracurricular_student->extracurricular_id === $extracurricular->id ? ' selected' : '') : (old('extracurricular_id') == $extracurricular->id ? ' selected' : '') }}
                            data-description="{{ $extracurricular->description }}">
                            {{ $extracurricular->name }}</option>
                    @endforeach
                </select>
                @error('extracurricular_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <input type="hidden" name="admin_id" value="{{ $admin->id }}">
            <div class="form-group local-forms">
                <label for="description">Description</label>
                <input type="text" id="description" name="description"
                    class="form-control @error('description') is-invalid @enderror"
                    value="{{ isset($extracurricular_student) ? $extracurricular_student->extracurricular->description : old('description') }}"
                    readonly>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <div class="student-submit">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ URL::to('extracurricular-student/') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script>
        function updateDescription() {
            const select = document.getElementById('extracurricular_id');
            const descriptionInput = document.getElementById('description');
            const selectedOption = select.options[select.selectedIndex];
            descriptionInput.value = selectedOption.getAttribute('data-description');
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            updateDescription();
        });
    </script>
@endsection
