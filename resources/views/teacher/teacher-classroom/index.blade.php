@extends('layouts.main')
@section('container')
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            <div class="col-auto text-end float-end ms-auto download-grp">
                <a href="{{ route('teacher-classroom.download') }}" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin' || auth()->user()->role === 'Teacher')
                    <a href="{{ URL::to('teacher/teacher-classroom/create') }}" class="btn btn-primary"><i
                            class="fas fa-plus"></i> New</a>
                @endif
            </div>
        </div>
    </div>

    <form id="filterForm" method="GET" action="{{ route('teacher-classroom.index') }}">
        <div class="row mb-3">
            <div class="col-md-4">
                <select name="classroom" id="classroom" class="form-select">
                    <option value="" {{ request('classroom') == '' ? 'selected' : '' }}>All Classes</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}" {{ request('classroom') == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->classroomType->name }} - {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="teacher-classroom-thread">
                <tr class="text-center">
                    <th>#</th>
                    <th>Classroom</th>
                    <th>Teacher Subject</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teacher_classrooms as $index => $teacher_classroom)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            {{ $teacher_classroom->teacherHomeroomRelationship->classroom->classroomType->name }} -
                            {{ $teacher_classroom->teacherHomeroomRelationship->classroom->name }}
                        </td>
                        <td class="text-center">
                            {{ $teacher_classroom->TeacherSubjectRelationship->teacher->name }}-{{ $teacher_classroom->teacherSubjectRelationship->subject->name }}
                        </td>
                        <td class="align-middle text-center">
                            @if (auth()->user()->role === 'Super Admin' || auth()->user()->role === 'Admin')
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('teacher-classroom.edit', $teacher_classroom->id) }}"
                                        class="btn btn-sm btn-outline-primary me-2" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                    <form method="POST"
                                        action="{{ route('teacher-classroom.destroy', $teacher_classroom->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button title="Delete" type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i
                                                class="fas fa-trash"></i></button>
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
