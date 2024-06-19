@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></li>
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

                @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Admin' || auth()->user()->role == 'Teacher')
                    <a href="{{ URL::to('parent/parent-list/create') }}" class="btn btn-primary"><i
                            class="fas fa-plus"></i>Add New</a>
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

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="parent-thread">
                <tr class="text-center">
                    <th>#</th>
                    <th>Identity Number</th>
                    <th>Name</th>
                    {{-- <th>Username</th> --}}
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    {{-- <th>NIK</th> --}}
                    {{-- <th>Address</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parents as $index => $parent)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $parent->identity_number }}</td>
                        <td>{{ $parent->name }}</td>
                        {{-- <td>{{ $parent->username }}</td> --}}
                        <td>{{ $parent->email }}</td>
                        <td>{{ $parent->gender }}</td>
                        <td>{{ $parent->born_date }}</td>
                        <td>{{ $parent->phone }}</td>
                        {{-- <td>{{ $parent->nik }}</td> --}}
                        {{-- <td>{{ $parent->address }}</td> --}}
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ URL::to('parent/parent-list/' . $parent->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>

                                {{-- Hanya tampilkan tombol "Edit" dan "Delete" untuk Super Admin dan Admin --}}
                                @if (auth()->user()->role == 'Super Admin' || auth()->user()->role == 'Admin')
                                    <a href="{{ URL::to('parent/parent-list/' . $parent->id) . '/edit' }}"
                                        class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form method="POST" action="{{ URL::to('parent/parent-list/' . $parent->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Anda yakin mau menghapus data orang tua {{ $parent->name }} ?')">
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
