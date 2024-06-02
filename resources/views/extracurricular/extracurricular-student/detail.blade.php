@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Extracurricular Student Detail</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="student_name">Student Name</label>
                        <input type="text" id="student_name" name="student_name" class="form-control" value="{{ $extracurricular_student->student->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="extracurricular_name">Extracurricular Name</label>
                        <input type="text" id="extracurricular_name" name="extracurricular_name" class="form-control" value="{{ $extracurricular_student->extracurricular->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control" value="{{ $extracurricular_student->description }}" readonly>
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::to('extracurricular/extracurricular-student/') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection