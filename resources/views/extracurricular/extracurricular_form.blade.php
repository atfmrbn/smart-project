@extends('layouts.main')
@section('container')
    @if (isset($extracurricular))
        <form method="POST" action="{{ URL::to('extracurricular/' . $extracurricular->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @method('put')
    @else
        <form method="POST" action="{{ URL::to('extracurricular') }}" autocomplete="off" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="name">Name <span class="login-danger">*</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($extracurricular) ? $extracurricular->name : old('name') }}" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</label>
                <input type="text" id="description" name="description"
                    class="form-control @error('description')is-invalid @enderror"
                    value="{{ isset($extracurricular) ? $extracurricular->description : old('description') }}" {{ isset($extracurricular_student) ? 'disabled' : '' }}>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <div class="student-submit">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ URL::to('extracurricular/') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection