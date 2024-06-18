@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h5 class="card-title mb-0">Student Detail</h5>
            </div>
            <div class="row">
                <div class="col-md-3 text-center mb-5">
                    @if($student->image)
                        <img src="{{ asset('images/' . $student->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 200px;">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Identity Number:</strong></label>
                                <p class="form-control-static">{{ $student->identity_number }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Name:</strong></label>
                                <p class="form-control-static">{{ $student->name }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Username:</strong></label>
                                <p class="form-control-static">{{ $student->username }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Email:</strong></label>
                                <p class="form-control-static">{{ $student->email }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Gender:</strong></label>
                                <p class="form-control-static">{{ $student->gender }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label><strong>Date of Birth:</strong></label>
                                <p class="form-control-static">{{ DateFormat($student->born_date, 'DD MMMM Y') }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Phone Number:</strong></label>
                                <p class="form-control-static">{{ $student->phone }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>NIK:</strong></label>
                                <p class="form-control-static">{{ $student->nik }}</p>
                            </div>
                            <div class="form-group">
                                <label><strong>Address:</strong></label>
                                <p class="form-control-static">{{ $student->address }}</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="{{ URL::to('student/student-list') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

    </div>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
