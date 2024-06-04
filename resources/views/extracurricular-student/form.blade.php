@extends('layouts.main')
@section('container')
    @if (isset($extracurricular_student))
        <form method="POST" action="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}"
            autocomplete="off">
            @method('put')
    @else
        <form method="POST" action="{{ URL::to('extracurricular-student') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="student_id">Student Name <span class="login-danger">*</label>
                <select class="form-control data-select-2" name="student_id" id="student_id" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ isset($extracurricular_student) ? ($extracurricular_student->student_id === $student->id ? ' selected' : '') : (old('student_id') == $student->id ? ' selected' : '') }}>
                            {{ $student->classroom_name }} - {{ $student->identity_number }}  - {{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group local-forms">
                <label for="extracurricular_id">Extracurricular Name <span class="login-danger">*</label>
                <select class="form-control data-select-2" name="extracurricular_id" id="extracurricular_id" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
                    <option value="">Select Extracurricular</option>
                    @foreach ($extracurriculars as $extracurricular)
                        <option value="{{ $extracurricular->id }}"
                            {{ isset($extracurricular_student) ? ($extracurricular_student->extracurricular_id === $extracurricular->id ? ' selected' : '') : (old('extracurricular_id') == $extracurricular->id ? ' selected' : '') }}>
                            {{ $extracurricular->name }}</option>
                    @endforeach
                </select>
                @error('extracurricular_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group local-forms"  style="display: none;">
                <label for="admin_id">Admin Name <span class="login-danger">*</label>
                {{-- <select class="form-control data-select-2" name="admin_id" id="admin_id" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
                    <option value="">Select Admin</option>
                    @foreach ($admins as $admin)
                        <option value="{{ $admin->id }}"
                            {{ isset($extracurricular_student) ? ($extracurricular_student->admin_id === $admin->id ? ' selected' : '') : (old('admin_id') == $admin->id ? ' selected' : '') }}>
                            {{ $admin->name }}</option>
                    @endforeach
                </select> --}}
                <select class="form-control data-select-2" name="admin_id" id="admin_id" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
                    <option value="{{ $admin->id }}" selected>{{ $admin->name }}</option>
                </select>
                @error('admin_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</label>
                <input type="text" id="description" name="description"
                    class="form-control @error('description')is-invalid @enderror"
                    value="{{ isset($extracurricular_student) ? $extracurricular_student->description : old('description') }}" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
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
@endsection
