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
                @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                    <a href="{{ URL::to('extracurricular-student/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus" aria-hidden="true"></i>Add New</a>
                @endif
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Student Name</th>
                    <th>Extracurricular Name</th>
                    <th>Description</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extracurricular_students as $index => $extracurricular_student)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $extracurricular_student->class_name }} -
                            {{ $extracurricular_student->identity_number }} - {{ $extracurricular_student->student_name }}
                        </td>
                        <td class="align-middle">{{ $extracurricular_student->extracurricular_name }}</td>
                        <td class="align-middle">{{ $extracurricular_student->extracurricular_description }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a title="View"
                                    href="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>

                                @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                                    <a href="{{ URL::to('extracurricular-student/' . $extracurricular_student->id . '/edit') }}"
                                        class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                            onclick="return confirm('Are you sure you want to delete this record {{ $extracurricular_student->student->name ?? 'N/A' }} ?')"><i
                                                class="fas fa-trash"></i></button>
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
