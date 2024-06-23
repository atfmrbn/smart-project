<!-- resources/views/profile/index.blade.php -->

@extends("layouts.main")

@section("container")

    <h1>{{ $title }}</h1>

    <div class="row mt-3">
        <div class="col-md-12 text-center">
            @if($user->image)
                <img class="rounded" src="{{ asset('images/' . Auth::user()->image) }}" width="300">
                {{-- <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="img-fluid rounded-circle mb-3"> --}}
            @else
                <img src="{{ asset('images/default.png') }}" alt="Default Profile Image" class="img-fluid rounded-circle mb-3">
            @endif
        </div>
    </div>

    <ul class="nav nav-tabs" id="profileTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-white" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true" style="background-color: #3D5EE1">Profile Information</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link text-white" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false" style="background-color: #3D5EE1">Kata Sandi</a>
        </li> --}}
    </ul>

    <div class="tab-content" id="profileTabContent">
        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="row mt-3">
                <div class="col-md-6">
                    {{-- <div class="card"> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Gender</th>
                                            <td>{{ ucfirst($user->gender) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Born Date</th>
                                            <td>{{ DateFormat($user->born_date, 'DD MMMM Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIK</th>
                                            <td>{{ $user->nik }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $user->address }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    {{-- </div> --}}
                    {{-- <a href="{{ route('profile.edit-profile') }}" class="btn btn-primary mt-3">Edit Profile</a> --}}
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
            <div class="row mt-3">
                <div class="col-md-6 offset">
                    <div class="card">
                        
                        <div class="card-body">
                            <form action="{{ URL::to('profile.update-password') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="password">Kata Sandi Baru</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
