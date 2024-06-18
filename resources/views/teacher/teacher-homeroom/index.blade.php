@extends('layouts.main')
@section('container')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            <div class="col-auto text-end float-end ms-auto download-grp">
                <a href="{{ route('teacher-homeroom.download') }}" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                    <a href="{{ route('teacher-homeroom.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New</a>
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
                    <th>Action</th>
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
                        <td class="align-middle text-center">
                            @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
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
