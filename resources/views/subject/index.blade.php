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
            @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                <div class="col-auto text-end float-end ms-auto download-grp">
                    <a href="{{ URL::to('subject/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New</a>
                </div>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Classroom Type</th>
                    <th>Name</th>
                    <th>Description</th>
                    @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $index => $subject)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $subject->classroomType->name }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->description }}</td>
                        @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                            <td class="align-middle text-center">
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ URL::to('subject/' . $subject->id) }}"
                                        class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ URL::to('subject/' . $subject->id . '/edit') }}"
                                        class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                    <form action="{{ URL::to('subject/' . $subject->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                            onclick="return confirm('Anda yakin mau menghapus data ini {{ $subject->name }}?')">
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
