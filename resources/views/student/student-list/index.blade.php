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
                <a href="{{ route('student.download') }}" class="btn btn-outline-primary me-2"><i
                        class="fas fa-download"></i> Download</a>
                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                    <a href="{{ URL::to('student/student-list/create') }}" class="btn btn-primary"><i
                        class="fas fa-plus"></i> New
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="student-thread">
                <tr class="text-center">
                    <th>#</th>
                    <th>Identity Number</th>
                    <th>Name</th>
                    {{-- <th>Username</th> --}}
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>Class</th>
                    {{-- <th>Address</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $index => $student)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td>{{ $student->identity_number }}</td>
                        <td>{{ $student->name }}</td>
                        {{-- <td>{{ $student->username }}</td> --}}
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->born_date }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->classroom_name }}</td>
                        {{-- <td>{{ $student->address }}</td> --}}
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin', 'Teacher']))
                                    <a href="{{ URL::to('student/student-list/' . $student->id) }}"
                                        class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                @else
                                    <div class="d-flex justify-content-center align-items-center">
                                        <span class="text-muted">No actions available</span>
                                    </div>
                                @endif

                                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                                    <a href="{{ URL::to('student/student-list/' . $student->id) . '/edit' }}"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ URL::to('student/student-list/' . $student->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Anda yakin mau menghapus siswa {{ $student->name }} ?')">
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
