@extends("layouts.main")

@section("container")

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="background-color: transparent; border: none;">
        @if (auth()->user()->role == 'Admin')
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        @elseif (auth()->user()->role == 'Super Admin')
            <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
        @elseif (auth()->user()->role == 'Student')
            <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
        @elseif (auth()->user()->role == 'Teacher')
            <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
        @elseif (auth()->user()->role == 'Parent')
            <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
</nav>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Profile</h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="profile-header">
                    <div class="row align-items-center">
                        <div class="col-auto profile-image">
                            @if ($user->image)
                            <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="img-thumbnail"
                                style="max-width: 200px;">
                        @else
                            <p>No image available</p>
                        @endif
                        </div>
                        <div class="col-auto profile-btn">
                            {{-- <a class="edit-link" data-bs-toggle="modal" href="#edit_profile_image"><i class="far fa-edit me-1"></i>Edit Photo</a> --}}
                        </div>
                    </div>
                </div>
                <div class="profile-menu" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content profile-tab-cont">

                    <div class="tab-pane fade show active" id="per_details_tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                        <h5 class="card-title d-flex justify-content-between">
                                            <span>Personal Details</span>
                                            <a class="edit-link" data-bs-toggle="modal" href="#edit_personal_details"><i class="far fa-edit me-1"></i>Edit</a>
                                        </h5>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                            <p class="col-sm-9">{{ $user->name }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Username</p>
                                            <p class="col-sm-9">{{ $user->username }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                                            <p class="col-sm-9">{{ $user->email }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Gender</p>
                                            <p class="col-sm-9">{{ ucfirst($user->gender) }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of Birth</p>
                                            <p class="col-sm-9">{{ $user->born_date }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Phone</p>
                                            <p class="col-sm-9">{{ $user->phone }}</p>
                                        </div>
                                        <div class="row">
                                            <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                            <p class="col-sm-9 mb-0">{{ $user->address }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="password_tab" class="tab-pane fade">
                        <div class="card" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <div class="row">
                                    <div class="col-12">
                                        <form action="{{ URL::to('/profile/update-password') }}" method="POST">
                                            @csrf
                                            <div class="col-12 mb-3">
                                                <label for="current_password" class="form-label">Current Password</label>
                                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="password" class="form-label">New Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Modal Edit Personal Details -->
                <div class="modal fade" id="edit_personal_details" tabindex="-1" aria-labelledby="editPersonalDetailsLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPersonalDetailsLabel">Edit Personal Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ URL::to('/profile/update-profile') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control data-select" name="gender" id="gender" required>
                                            <option selected disabled>Select Gender</option>
                                            <option value="Laki-laki" {{ isset($user) ? ($user->gender === 'Laki-laki' ? ' selected' : '') : '' }}>
                                                Male</option>
                                            <option value="Perempuan" {{ isset($user) ? ($user->gender === 'Perempuan' ? ' selected' : '') : '' }}>
                                                Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="born_date" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="born_date" name="born_date" value="{{ $user->born_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea class="form-control" id="address" name="address">{{ $user->address }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit Profile Image -->
                {{-- <div class="modal fade" id="edit_profile_image" tabindex="-1" aria-labelledby="editProfileImageLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileImageLabel">Edit Profile Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ URL::to('/profile.update-image') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="profile_image" class="form-label">Upload New Profile Image</label>
                                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</div>
@endsection
