@extends('layouts.main')
@section('container')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            <div class="col-auto text-end float-end ms-auto download-grp">
                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                <a href="{{ route('teacher.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="teacher-thread">
                <tr class="text-center">
                    <th>#</th>
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
                @foreach ($teachers as $index => $teacher)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->username }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->gender }}</td>
                        <td>{{ $teacher->born_date }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->nik }}</td>
                        <td>{{ $teacher->address }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('teacher.edit', $teacher->id) }}"
                                    class="btn btn-sm btn-outline-primary me-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('teacher.destroy', $teacher->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Anda yakin mau menghapus siswa {{ $teacher->name }} ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
