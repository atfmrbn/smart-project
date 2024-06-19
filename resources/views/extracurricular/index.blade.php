@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
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
                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                    <a href="{{ URL::to('extracurricular/create') }}" class="btn btn-primary">
                        <i class="fas fa-plus" aria-hidden="true"></i>Add New</a>
                @endif
            </div>
        </div>
    </div>

    <div class="table-responsive mt-5">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th width="5%">No.</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extracurriculars as $index => $extracurricular)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $extracurricular->name }}</td>
                        <td class="align-middle">{{ $extracurricular->description }}</td>
                        <td class="align-middle">
                            <div class="d-flex justify-content-center">
                                <a title="Lihat" href="{{ URL::to('extracurricular/' . $extracurricular->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                                    <a href="{{ URL::to('extracurricular/' . $extracurricular->id . '/edit') }}"
                                        class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ URL::to('extracurricular/' . $extracurricular->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                            onclick="return confirm('Anda yakin mau menghapus data ini {{ $extracurricular->name }} ?')">
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
