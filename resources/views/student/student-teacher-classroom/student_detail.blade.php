@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="name">Student Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $student->name }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="username">Username <span class="login-danger">*</span></label>
                <input type="text" id="username" name="username" class="form-control" value="{{ $student->username }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="email">Email <span class="login-danger">*</span></label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $student->email }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="gender">Gender <span class="login-danger">*</span></label>
                <input type="text" id="gender" name="gender" class="form-control" value="{{ $student->gender }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="born_date">Date of Birth <span class="login-danger">*</span></label>
                <input type="date" id="born_date" name="born_date" class="form-control" value="{{ $student->born_date }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="phone">Phone Number <span class="login-danger">*</span></label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $student->phone }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="nik">NIK <span class="login-danger">*</span></label>
                <input type="number" min="0" id="nik" name="nik" class="form-control"
                    value="{{ $student->nik }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="address">Address <span class="login-danger">*</span></label>
                <input type="text" id="address" name="address" class="form-control" value="{{ $student->address }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="student-submit">
                <a href="{{ URL::to('student/student-teacher-classroom/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>

@endsection
