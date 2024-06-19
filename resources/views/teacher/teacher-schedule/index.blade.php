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
                @if (in_array(Auth::user()->role, ['Super Admin', 'Admin', 'Teacher']))
                    <a href="{{ route('teacher-schedule.download') }}" class="btn btn-outline-primary me-2"><i
                            class="fas fa-download"></i> Download</a>
                    <a href="{{ URL::to('teacher/teacher-schedule/create') }}" class="btn btn-primary"><i
                            class="fas fa-plus"></i> New</a>
                @endif
            </div>
        </div>
    </div>

    <form id="filterForm" method="GET" action="{{ route('teacher-schedule.index') }}">
        <div class="row mb-3">
            <div class="col-md-5">
                <select name="teacher_classroom_relationship_id" id="teacher_classroom_relationship_id"
                    class="form-control data-select-2">
                    <option value="" {{ request('teacher_classroom_relationship_id') == '' ? 'selected' : '' }}>All
                        Classes</option>
                    @foreach ($teacherClassroomRelationships as $teacherClassroomRelationship)
                        <option value="{{ $teacherClassroomRelationship->id }}"
                            {{ request('teacher_classroom_relationship_id') == $teacherClassroomRelationship->id ? 'selected' : '' }}>
                            {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }}
                            -
                            {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }} -
                            {{ $teacherClassroomRelationship->teacherSubjectRelationship->teacher->name }} -
                            {{ $teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-responsive" id="example">
        <thead class="teacher-schedule-thread">
            <tr class="text-center">
                <th>#</th>
                <th>Classroom</th>
                <th>Teacher</th>
                <th>Schedule</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacherSchedules as $index => $teacherSchedule)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }}
                        -
                        {{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }}
                    </td>
                    <td class="text-center">{{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->teacher->name }} -
                        {{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
                    </td>
                    <td class="text-center">{{ $teacherSchedule->schedule_day }}
                        {{ \Carbon\Carbon::parse($teacherSchedule->schedule_time_start)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($teacherSchedule->schedule_time_end)->format('H:i') }}
                    </td>
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center align-items-center">
                            @if (in_array(Auth::user()->role, ['Super Admin', 'Admin']))
                                <a href="{{ route('teacher-schedule.edit', $teacherSchedule->id) }}"
                                    class="btn btn-sm btn-outline-primary me-2" title="Edit"><i
                                        class="fas fa-edit"></i></a>
                                <form method="POST"
                                    action="{{ route('teacher-schedule.destroy', $teacherSchedule->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button title="Delete" type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this data?')"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            @else
                                <div class="d-flex justify-content-center align-items-center">
                                    <span class="text-muted">No actions available</span>
                                </div>
                            @endif
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
