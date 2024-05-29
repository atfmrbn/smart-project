@extends('layouts.main')
@section('container')
    @if (isset($classroom))
        <form method="POST" action="{{ URL::to('classroom/' . $classroom->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('classroom') }}" autocomplete="off" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="classroom_type_id">Classroom Type ID</label>
                <select class="form-control" name="classroom_type_id" id="classroom_type_id">
                    @foreach ($classroom_types as $classroom_type)
                        <option value="{{ $classroom_type->id }}"
                            {{ isset($classroom) ? ($classroom->classroom_type_id === $classroom_type->id ? ' selected' : '') : '' }}>
                            {{ $classroom_type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($classroom) ? $classroom->name : old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col-12">
                <div class="student-submit">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ URL::to('classroom/') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
        </form>
    @endsection
