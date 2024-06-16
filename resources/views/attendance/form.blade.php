@extends('layouts.main')
@section('container')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(isset($attendance))
<form method="POST" action="{{ URL::to('attendance/' . $attendance->id) }}">
    @method('put')
@else
<form method="POST" action="{{ URL::to('attendance') }}">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="student_teacher_homeroom_id">Student Teacher Homeroom <span class="login-danger">*</span></label>
                <select name="student_teacher_homeroom_id" id="student_teacher_homeroom_id" class="form-control data-select-2 @error('student_teacher_homeroom_id') is-invalid @enderror">
                    <option value="">Select Student Teacher Homeroom</option>
                    @foreach ($studentTeacherHomeroomRelationships as $studentTeacherHomeroomRelationship) 
                        <option value="{{ $studentTeacherHomeroomRelationship->id }}" {{ isset($attendance) && $attendance && $attendance->student_teacher_homeroom_id === $studentTeacherHomeroomRelationship->id ? 'selected' : '' }}>
                            {{ $studentTeacherHomeroomRelationship->student->identity_number }} - {{ $studentTeacherHomeroomRelationship->student->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ optional($studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher)->identity_number }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('student_teacher_homeroom_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>   
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="attendance_date">Attendance Date <span class="login-danger">*</span></label>
                <input type="date" name="attendance_date" id="attendance_date" class="form-control @error('attendance_date') is-invalid @enderror" value="{{ isset($attendance) ? $attendance->attendance_date : old('attendance_date') }}">
                @error('attendance_date')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div> 
        </div>  

        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="status">Status <span class="login-danger">*</span></label>
                <select name="status" id="status" class="form-control data-select-2 @error('status') is-invalid @enderror">
                    <option value="">Select Status</option>
                    <option value="Masuk" {{ isset($attendance) && $attendance->status == "Masuk" ? 'selected' : '' }}>Masuk</option>
                    <option value="Bolos" {{ isset($attendance) && $attendance->status == "Bolos" ? 'selected' : '' }}>Bolos</option>
                    <option value="Ijin" {{ isset($attendance) && $attendance->status == "Ijin" ? 'selected' : '' }}>Ijin</option>
                    <option value="Sakit" {{ isset($attendance) && $attendance->status == "Sakit" ? 'selected' : '' }}>Sakit</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="note">Note</label>
                <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{ isset($attendance) ? $attendance->note : old('note') }}</textarea>
                @error('note')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div> 
        </div>  


        <div class="col-12 col-sm-6">
            <button type="submit" class="btn btn-primary ">Submit</button>
                <a href="{{ URL::to('attendance/')  }}" class="btn  btn-secondary">Back</a>
        </div>
    </div>
</form>


@endsection
