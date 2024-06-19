@extends('layouts.main')
@section('title', $title)
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Librarian')
                <li class="breadcrumb-item"><a href="{{ route('librarian.dashboard') }}">Dashboard</a></li>
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
            @if (in_array(Auth::user()->role, ['Super Admin', 'Admin', 'Librarian']))
                <div class="col-auto text-end float-end ms-auto download-grp">
                    <a href="{{ URL::to('book-category/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New</a>
                </div>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped " style="width:100%">
            <thead class="student-thread">
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td class="align-middle text-center">
                            @if (in_array(Auth::user()->role, ['Super Admin', 'Admin', 'Librarian']))
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ URL::to('book-category/' . $category->id . '/edit') }}" title="Edit"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ URL::to('book-category/' . $category->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                            onclick="return confirm('Anda yakin mau menghapus kategori {{ $category->name }} ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="text-muted">No actions available</span>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
