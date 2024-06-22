@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Parent')
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            <div class="col-auto text-end float-end ms-auto download-grp">
                <a href="{{ route('student-teacher.download') }}" class="btn btn-outline-primary me-2"><i
                    class="fas fa-download"></i> Download</a>
                @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Admin')
                    <a href="{{ URL::to('student/student-teacher-homeroom/create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i> New
                    </a>
                @endif
            </div>
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
        </div>
    </div>

    <form id="filterForm" method="GET" action="{{ route('student-teacher-homeroom.index') }}" class="mb-4">
        <div class="row mb-3">
            <div class="col-md-3">
                <select name="classroom" id="classroom" class="form-select">
                    <option value="" {{ request('classroom') == '' ? 'selected' : '' }}>All Classroom</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ request('classroom') == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table id="example" class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Student</th>
                    <th>Teacher Homeroom</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentTeacherHomeroomRelationships as $index => $studentTeacherHomeroomRelationship)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $studentTeacherHomeroomRelationship->identity_number }} -
                            {{ $studentTeacherHomeroomRelationship->student->name }}</td>
                        <td>{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} -
                            {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->identity_number }}
                            -{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a title="Lihat"
                                    href="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>

                                @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Admin')
                                    <a title="Edit"
                                        href="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id . '/edit') }}"
                                        class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>

                                    <form
                                        action="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger me-2"
                                            onclick="return confirm('Anda yakin mau menghapus data ini {{ $studentTeacherHomeroomRelationship->student->name }}?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
