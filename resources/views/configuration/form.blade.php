@extends('layouts.main')
@section('container')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($configuration))
        <form method="POST" action="{{ URL::to('configuration/' . $configuration->id) }}" autocomplete="off" enctype="multipart/form-data">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('configuration') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="name">Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($configuration) ? $configuration->name : old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="address">Address <span class="login-danger">*</span></label>
                <input type="text" id="address" name="address"
                    class="form-control @error('address')is-invalid @enderror"
                    value="{{ isset($configuration) ? $configuration->address : old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="phone">Phone <span class="login-danger">*</span></label>
                <input type="text" id="phone" name="phone" class="form-control @error('phone')is-invalid @enderror"
                    value="{{ isset($configuration) ? $configuration->phone : old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="email">Email <span class="login-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control @error('email')is-invalid @enderror"
                    value="{{ isset($configuration) ? $configuration->email : old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="book_penalty">Penalty <span class="login-danger">*</span></label>
                <input type="book_penalty" id="book_penalty" name="book_penalty" class="form-control @error('book_penalty')is-invalid @enderror"
                    value="{{ isset($configuration) ? $configuration->book_penalty : old('book_penalty') }}">
                @error('book_penalty')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        
        <div class="col-12">
            <div class="configuration-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ URL::to('configuration/') }}" class="btn btn-secondary">Back</a>
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
