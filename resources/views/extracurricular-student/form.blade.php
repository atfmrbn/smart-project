@extends('layouts.main')
@section('container')
    @if (isset($extracurricular_student))
        <form method="POST" action="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}" autocomplete="off">
            @method('put')
    @else
        <form method="POST" action="{{ URL::to('extracurricular-student') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="student_id">Student Name <span class="login-danger">*</span></label>
                <select class="form-control data-select-2" name="student_id" id="student_id">
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ isset($extracurricular_student) ? ($extracurricular_student->student_id === $student->id ? ' selected' : '') : (old('student_id') == $student->id ? ' selected' : '') }}>
                            {{ $student->class_name }} - {{ $student->identity_number }}  - {{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group local-forms">
                <label for="extracurricular_id">Extracurricular Name <span class="login-danger">*</span></label>
                <select class="form-control data-select-2" name="extracurricular_id" id="extracurricular_id" onchange="updateDescription()">
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
                <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($extracurricular_student) ? $extracurricular_student->extracurricular->description : old('description') }}" readonly>
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
