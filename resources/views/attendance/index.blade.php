@extends('layouts.main')
@section('container')

@if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="{{ URL::to('attendance/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Teacher Homeroom</th>
                <th>Attendance Date</th>
                <th>Note</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $index => $attendance)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attendance->studentTeacherHomeroomRelationship->student->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->student->name }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ optional($attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher)->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}</td>
                    <td>{{ date('d-m-Y', strtotime($attendance->attendance_date)) }}</td>
                    <td>{{ $attendance->note }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ URL::to('attendance/' . $attendance->id) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                        <a href="{{ URL::to('attendance/' . $attendance->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ URL::to('attendance/' . $attendance->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $attendance->name }}?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
