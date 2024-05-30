@extends('layouts.main')
@section('container')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($teacher_homeroom))
        <form method="POST" action="{{ route('teacher-homeroom.update', $teacher_homeroom->id) }}" autocomplete="off" enctype="multipart/form-data">
            @method('put')
    @else
        <form method="POST" action="{{ route('teacher-homeroom.store') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="teacher_id">Teacher <span class="login-danger">*</span></label>
                <select name="teacher_id" id="teacher_id" class="form-control data-select-2">
                    <option value="">Select Teacher</option>
                    {{-- @if(isset($teacher_homerooms)) --}}
                        @foreach ($teacher_homerooms as $teacher)
                            <option value="{{ $teacher->id }}" {{ (isset($teacher_homeroom) && $teacher_homeroom->teacher_id == $teacher->id) ? 'selected' : '' }}>
                                {{ $teacher->teachers }}
                            </option>
                        @endforeach
                    {{-- @endif --}}
                </select>
            </div>
        </div>
        {{-- <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="teacher_id">Teacher <span class="login-danger">*</span></label>
                <input type="text" id="teacher_id" name="teacher_id"
                    class="form-control @error('teacher_id')is-invalid @enderror"
                    value="{{ isset($teacher_homeroom) ? $teacher_homeroom->teacher_id : old('teacher_id') }}">
                @error('teacher_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div> --}}

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="classroom_id">Classroom <span class="login-danger">*</span></label>
                <input type="text" id="classroom_id" name="classroom_id"
                    class="form-control @error('classroom_id')is-invalid @enderror"
                    value="{{ isset($teacher_homeroom) ? $teacher_homeroom->classroom_id : old('classroom_id') }}">
                @error('classroom_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="curriculum_id">Curriculum <span class="login-danger">*</span></label>
                <input type="text" id="curriculum_id" name="curriculum_id"
                    class="form-control @error('curriculum_id')is-invalid @enderror"
                    value="{{ isset($teacher_homeroom) ? $teacher_homeroom->curriculum_id : old('curriculum_id') }}">
                @error('curriculum_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12">
            <div class="teacher_homeroom-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('teacher-homeroom.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
    <script>
        document.getElementById('phone').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^+\d]/g, '');
        });
    </script>
@endsection
