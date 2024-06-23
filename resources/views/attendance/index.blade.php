@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session()->has('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
    @endif

    @if (session()->has('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>

    @endif

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            <div class="col-auto text-end float-end ms-auto download-grp">
                <a href="{{ route('attendance.download') }}" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                <a href="{{ URL::to('attendance/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New</a>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
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
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $attendance->studentTeacherHomeroomRelationship->student->identity_number }} -
                            {{ $attendance->studentTeacherHomeroomRelationship->student->name }} -
                            {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }}
                            -
                            {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}
                        </td>
                        <td>{{ DateFormat($attendance->attendance_date, 'DD MMMM Y') }}</td>
                        <td>{{ $attendance->note }}</td>
                        <td>{{ $attendance->status }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ URL::to('attendance/' . $attendance->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ URL::to('attendance/' . $attendance->id . '/edit') }}"
                                    class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                <form action="{{ URL::to('attendance/' . $attendance->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                        onclick="return confirm('Anda yakin mau menghapus data ini {{ $attendance->name }}?')">
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
