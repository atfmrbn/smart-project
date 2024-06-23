@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Librarian')
                <li class="breadcrumb-item"><a href="{{ route('librarian.dashboard') }}">Dashboard</a></li>
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
                <a href="{{ route('librarian.download') }}" class="btn btn-outline-primary me-2"><i
                    class="fas fa-download"></i> Download</a>
                <a href="{{ route('librarian.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add New</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="librarian-thread">
                <tr class="text-center">
                    <th>#</th>
                    <th>Identity Number</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>NIK</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($librarians as $index => $librarian)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $librarian->identity_number }}</td>
                        <td>{{ $librarian->name }}</td>
                        <td>{{ $librarian->username }}</td>
                        <td>{{ $librarian->email }}</td>
                        <td>{{ $librarian->gender }}</td>
                        <td>{{ $librarian->born_date }}</td>
                        <td>{{ $librarian->phone }}</td>
                        <td>{{ $librarian->nik }}</td>
                        <td>{{ $librarian->address }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('librarian.edit', $librarian->id) }}"
                                    class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if (in_array(auth()->user()->role, ['Super Admin', 'Admin']))
                                    <form method="POST" action="{{ route('librarian.destroy', $librarian->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Anda yakin mau menghapus siswa {{ $librarian->name }} ?')">
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
