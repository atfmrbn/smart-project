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
                <a href="{{ route('teacher-homeroom.download') }}" class="btn btn-outline-primary me-2"><i
                        class="fas fa-download"></i> Download</a>
                @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                    <a href="{{ route('teacher-homeroom.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                        New</a>
                @endif
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="teacher-homeroom-thread">
                <tr class="text-center">
                    <th>#</th>
                    <th>Teacher</th>
                    <th>Classroom</th>
                    <th>Curriculum</th>
                    @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($teacher_homerooms as $index => $teacher_homeroom)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $teacher_homeroom->teacher->name }}</td>
                        <td class="text-center">{{ $teacher_homeroom->classroom->classroomType->name }} -
                            {{ $teacher_homeroom->classroom->name }}</td>
                        <td class="text-center">{{ $teacher_homeroom->curriculum->year }}</td>
                        @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('teacher-homeroom.edit', $teacher_homeroom->id) }}"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST"
                                        action="{{ route('teacher-homeroom.destroy', $teacher_homeroom->id) }}">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Anda yakin mau menghapus guru {{ $teacher_homeroom->teacher->name }} ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
