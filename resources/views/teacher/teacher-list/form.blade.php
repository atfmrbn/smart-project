@extends('layouts.main')
@section('container')

@if(isset($user))
<form method="POST" action="{{ URL::to('teacher/teacher-list' . $user->id) }}">
    @method('put')
@else
<form method="POSt" action="{{ URL::to('teacher/teacher-list') }}">
@endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control  @error('name')is-invalid @enderror" value="{{ isset($user)? $user->name : old('name')}}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" id="username" name="username" class="form-control  @error('username')is-invalid @enderror" value="{{ isset($user)? $user->username : old('username')}}">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="text" id="email" name="email" class="form-control  @error('email')is-invalid @enderror" value="{{ isset($user)? $user->email : old('email')}}">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Password</label>
                <input type="password" id="password" name="password" class="form-control  @error('password')is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Gender</label>
                <input type="gender" id="gender" name="gender" class="form-control  @error('gender')is-invalid @enderror">
                @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Born Date</label>
                <input type="born-date" id="born-date" name="born-date" class="form-control  @error('born-date')is-invalid @enderror">
                @error('born-date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Phone</label>
                <input type="phone" id="phone" name="phone" class="form-control  @error('phone')is-invalid @enderror">
                @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">NIK</label>
                <input type="nik" id="nik" name="nik" class="form-control  @error('nik')is-invalid @enderror">
                @error('nik')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Address</label>
                <input type="address" id="address" name="address" class="form-control  @error('address')is-invalid @enderror">
                @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-12 col-sm-4">
                <div class="form-group local-forms" style="display: none;">
                    <label for="role">Role <span class="login-danger">*</span></label>
                    <input type="text" class="form-control" name="role" id="role" value="Teacher" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{ URL::to('teacher/teacher-list/')  }}" class="btn  btn-secondary">Back</a>
        </div>
    </div>
</form>


@endsection
