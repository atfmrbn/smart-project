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
    @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="{{ URL::to('classroom/create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> New</a>
        </div>
    @endif
    <div class="col-12">
        <h4 class="form-title">{{ $title }}</h4>
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

    <div class="table-responsive mt-5">
        <table id="example" class="table table-striped table-bordered table-responsive">
            <thead>
                <tr class="text-center">
                    <th width="5%">#</th>
                    {{-- <th class="text-center">Classroom Type ID</th> --}}
                    <th>Classroom Type Name</th>
                    <th>Name</th>
                    @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                        <th width="10%">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $index => $classroom)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        {{-- <td class="align-middle text-center">{{ $classroom->classroom_type_id }}</td> --}}
                        <td class="align-middle">{{ $classroom->classroomType->name }}</td>
                        <td class="text-center">{{ $classroom->name }}</td>
                        @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                            <td>
                                <div class="d-flex">
                                    <a title="Lihat" href="{{ URL::to('classroom/' . $classroom->id) }}"
                                        class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ URL::to('classroom/' . $classroom->id . '/edit') }}"
                                        class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ URL::to('classroom/' . $classroom->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                            onclick="return confirm('Anda yakin mau menghapus kelas {{ $classroom->name }} ?')">
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
    @endsection
