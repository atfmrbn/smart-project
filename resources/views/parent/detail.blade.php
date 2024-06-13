@extends('layouts.main')
@section('title', $title)
@section('container')
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="identity_number">Identity Number <span class="login-danger">*</span></label>
                <input type="number" min="0" id="identity_number" name="identity_number" class="form-control"
                    value="{{ $parent->identity_number }}" readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="name">Parent Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $parent->name }}" readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="username">Username <span class="login-danger">*</span></label>
                <input type="text" id="username" name="username" class="form-control" value="{{ $parent->username }}"
                    readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="email">Email <span class="login-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $parent->email }}"
                    readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="gender">Gender <span class="login-danger">*</span></label>
                <input type="text" id="gender" name="gender" class="form-control" value="{{ $parent->gender }}"
                    readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="born_date">Date of Birth <span class="login-danger">*</span></label>
                <input type="date" id="born_date" name="born_date" class="form-control" value="{{ $parent->born_date }}"
                    readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="phone">Phone Number <span class="login-danger">*</span></label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $parent->phone }}"
                    readonly>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group local-forms">
                <label for="nik">NIK <span class="login-danger">*</span></label>
                <input type="number" min="0" id="nik" name="nik" class="form-control"
                    value="{{ $parent->nik }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="address">Address <span class="login-danger">*</span></label>
                <input type="text" id="address" name="address" class="form-control" value="{{ $parent->address }}"
                    readonly>
            </div>
        </div>

        <!-- Section for Profile Image -->
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="image">Profile Image</label>
                @if($parent->image)
                    <img src="{{ asset('images/' . $parent->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                @else
                    <p>No image available</p>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="parent-submit">
                <a href="{{ URL::to('parent/parent-list/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
