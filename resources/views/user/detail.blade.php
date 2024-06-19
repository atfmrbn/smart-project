@extends('layouts.main')

@section('container')
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/user') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="row">
            <div class="col-md-3 text-center mb-5">
                @if ($user->image)
                    <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="img-thumbnail"
                        style="max-width: 200px;">
                @else
                    <p>No image available</p>
                @endif
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group local-forms">
                            <label><strong>Identity Number:</strong></label>
                            <input type="number" min="0" id="identity_number" name="identity_number"
                                class="form-control" value="{{ $user->identity_number }}" readonly>
                        </div>
                        <div class="form-group local-forms">

                            <label><strong>Name:</strong></label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ $user->name }}" readonly>
                        </div>
                        <div class="form-group local-forms">
                            <label><strong>Username:</strong></label>
                            <input type="text" id="username" name="username" class="form-control"
                                value="{{ $user->username }}" readonly>
                        </div>
                        <div class="form-group local-forms">
                            <label><strong>Email:</strong></label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ $user->email }}" readonly>
                        </div>
                        <div class="form-group local-forms">
                            <label><strong>Gender:</strong></label>
                            <input type="text" id="gender" name="gender" class="form-control"
                                value="{{ $user->gender }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group local-forms">
                            <label><strong>Date of Birth:</strong></label>
                            <input id="born_date" name="born_date" class="form-control"
                                value="{{ DateFormat($user->born_date, 'DD MMMM Y') }}" readonly>
                        </div>
                        <div class="form-group local-forms">
                            <label><strong>Phone Number:</strong></label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                value="{{ $user->phone }}" readonly>
                        </div>
                        <div class="form-group local-forms">
                            <label><strong>NIK:</strong></label>
                            <input type="number" min="0" id="nik" name="nik" class="form-control"
                                value="{{ $user->nik }}" readonly>
                        </div>
                        <div class="form-group local-forms">
                            <label><strong>Address:</strong></label>
                            <input type="text" id="address" name="address" class="form-control"
                                value="{{ $user->address }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right">
            <div class="user-submit">
                <a href="{{ URL::to('user/user-list') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
