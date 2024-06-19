@extends('layouts.main')
@section('title', $title)
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/parent/parent-list') }}">Parents</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($parent))
        <form method="POST" action="{{ URL::to('parent/parent-list/' . $parent->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @method('put')
        @else
            <form method="POST" action="{{ URL::to('parent/parent-list') }}" autocomplete="off"
                enctype="multipart/form-data">
    @endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="identity_number">Identity Number <span class="login-danger">*</span></label>
                <input type="text" id="identity_number" name="identity_number"
                    class="form-control @error('identity_number')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->identity_number : old('identity_number') }}" autofocus>
                @error('identity_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="name">Parent Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->name : old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="username">Username <span class="login-danger">*</span></label>
                <input type="text" id="username" name="username"
                    class="form-control @error('username')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->username : old('username') }}">
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="password">Password <span class="login-danger">*</span></label>
                <input type="password" id="password" name="password"
                    class="form-control @error('password')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->password : old('password') }}">
                @error('password')
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
                    value="{{ isset($parent) ? $parent->email : old('email') }}">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="gender">Gender <span class="login-danger">*</span></label>
                <select class="form-control data-select-2" name="gender" id="gender" required>
                    <option selected disabled>Select Gender</option>
                    <option value="Laki-laki"
                        {{ isset($parent) ? ($parent->gender === 'Laki-laki' ? ' selected' : '') : '' }}>Male</option>
                    <option value="Perempuan"
                        {{ isset($parent) ? ($parent->gender === 'Perempuan' ? ' selected' : '') : '' }}>Female</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="born_date">Date of Birth <span class="login-danger">*</span></label>
                <input type="date" id="born_date" name="born_date"
                    class="form-control @error('born_date')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->born_date : old('born_date') }}">
                @error('born_date')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="phone">Phone Number <span class="login-danger">*</span></label>
                <input type="text" id="phone" name="phone"
                    class="form-control @error('phone')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->phone : old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="nik">NIK <span class="login-danger">*</span></label>
                <input type="number" min="0" id="nik" name="nik"
                    class="form-control @error('nik')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->nik : old('nik') }}">
                @error('nik')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-8">
            <div class="form-group local-forms">
                <label for="address">Address <span class="login-danger">*</span></label>
                <input type="text" id="address" name="address"
                    class="form-control @error('address')is-invalid @enderror"
                    value="{{ isset($parent) ? $parent->address : old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="students">Select Child <span class="login-danger">*</span></label>
                <select class="form-control data-select-2" name="students[]" id="students" multiple>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ isset($parent) && $parent->students->contains($student->id) ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="students">Select Child</label>
                <select name="students[]" class="form-control data-select-2" id="students" >
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <div class="col-12 col-sm-8">
            <div class="form-group local-forms">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="image"
                    class="form-control @error('image')is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms" style="display: none;">
                <label for="role">Role <span class="login-danger">*</span></label>
                <input type="text" class="form-control" name="role" id="role" value="Parent" required>
            </div>
        </div>
        <div class="col-12">
            <div class="parent-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ URL::to('parent/parent-list/') }}" class="btn btn-secondary">Back</a>
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
