@extends('layouts.main')
@section('container')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (isset($librarian))
        <form method="POST" action="{{ route('librarian.update', $librarian->id) }}" autocomplete="off" enctype="multipart/form-data">
            @method('put')
    @else
        <form method="POST" action="{{ route('librarian.store') }}" autocomplete="off">
    @endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="identity_number">Identity Number <span class="login-danger">*</span></label>
                <input type="text" id="identity_number" name="identity_number" class="form-control @error('identity_number')is-invalid @enderror"
                    value="{{ isset($librarian) ? $librarian->identity_number : old('identity_number') }}">
                @error('identity_number')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="name">Librarian Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror"
                    value="{{ isset($librarian) ? $librarian->name : old('name') }}">
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
                    value="{{ isset($librarian) ? $librarian->username : old('username') }}">
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
                    value="{{ isset($librarian) ? $librarian->password : old('password') }}">
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
                    value="{{ isset($librarian) ? $librarian->email : old('email') }}">
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
                <select class="form-control select" name="gender" id="gender" required>
                    <option selected disabled>Select Gender</option>
                    <option value="Laki-laki"
                        {{ isset($librarian) ? ($librarian->gender === 'Laki-laki' ? ' selected' : '') : '' }}>Male</option>
                    <option value="Perempuan"
                        {{ isset($librarian) ? ($librarian->gender === 'Perempuan' ? ' selected' : '') : '' }}>Female</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="born_date">Date of Birth <span class="login-danger">*</span></label>
                <input type="date" id="born_date" name="born_date"
                    class="form-control @error('born_date')is-invalid @enderror"
                    value="{{ isset($librarian) ? $librarian->born_date : old('born_date') }}">
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
                <input type="text" id="phone" name="phone" class="form-control @error('phone')is-invalid @enderror"
                    value="{{ isset($librarian) ? $librarian->phone : old('phone') }}">
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
                    value="{{ isset($librarian) ? $librarian->nik : old('nik') }}">
                @error('nik')
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
                    value="{{ isset($librarian) ? $librarian->address : old('address') }}">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms" style="display: none;">
                <label for="role">Role <span class="login-danger">*</span></label>
                <input type="text" class="form-control" name="role" id="role" value="Librarian" required>
            </div>
        </div>
        <div class="col-12">
            <div class="librarian-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('librarian.index') }}" class="btn btn-secondary">Back</a>
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
