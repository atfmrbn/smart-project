@extends("layouts.main")

@section("container")
<div class="container">
    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profile.update-profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="identity_number">Identity Number</label>
            <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ $user->identity_number }}" required>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control data-select" name="gender" id="gender" required>
                <option selected disabled>Select Gender</option>
                <option value="Laki-laki" {{ isset($user) ? ($user->gender === 'Laki-laki' ? ' selected' : '') : '' }}>
                    Male</option>
                <option value="Perempuan" {{ isset($user) ? ($user->gender === 'Perempuan' ? ' selected' : '') : '' }}>
                    Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="born_date">Born Date</label>
            <input type="date" class="form-control" id="born_date" name="born_date" value="{{ $user->born_date }}" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>
        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" required>{{ $user->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" width="100">
            @endif
        </div>
        <div class="col-12">
            <div class="user-submit">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ URL::to('profile/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </form>
</div>
@endsection
