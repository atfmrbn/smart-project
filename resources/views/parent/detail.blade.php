@extends('layouts.main')
@section('title', 'My Profile')
@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h5 class="card-title mb-0">Parent Detail</h5>
            </div>
            <div class="row">
                <div class="col-md-3 text-center mb-5">
                    @if($parent->image)
                        <img src="{{ asset('images/' . $parent->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Identity Number:</strong></label>
                                <p class="form-control-static">{{ $parent->identity_number }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Name:</strong></label>
                                <p class="form-control-static">{{ $parent->name }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Username:</strong></label>
                                <p class="form-control-static">{{ $parent->username }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Email:</strong></label>
                                <p class="form-control-static">{{ $parent->email }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Gender:</strong></label>
                                <p class="form-control-static">{{ $parent->gender }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Date of Birth:</strong></label>
                                <p class="form-control-static">{{ DateFormat($parent->born_date, 'DD MMMM Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Phone Number:</strong></label>
                                <p class="form-control-static">{{ $parent->phone }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>NIK:</strong></label>
                                <p class="form-control-static">{{ $parent->nik }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Address:</strong></label>
                                <p class="form-control-static">{{ $parent->address }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Children:</strong></label>
                                <ul>
                                    @foreach ($parent->students as $student)
                                        <li>{{ $student->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ URL::to('parent/parent-list') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

    </div>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
