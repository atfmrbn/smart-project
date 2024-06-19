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

<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Grade Details</h3>
            </div>
            @if (Auth::user()->role == 'Teacher')
                <div class="col-auto text-end float-end ms-auto download-grp">
                    <div class="btn-group" role="group" aria-label="Actions">
                        <a href="{{ route('grade-detail.download') }}" class="btn btn-outline-primary me-2"><i
                                class="fas fa-download"></i> Download</a>
                        <a href="{{ route('grade-detail.create') }}" class="btn btn-primary"><i
                                class="fas fa-plus me-1"></i> New</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <form id="filterForm" method="GET" action="{{ route('grade-detail.index') }}">
        <div class="row mb-3">
            <div class="col-md-6">
                <select name="grade_id" id="grade_id"
                    class="form-control data-select-2 @error('grade_id') is-invalid @enderror">
                    <option value="">All Grade</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}" {{ request('grade_id') == $grade->id ? 'selected' : '' }}>
                            {{ $grade->taskType->name ?? '' }} -
                            {{ optional($grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom)->classroomType->name ?? '' }}
                            -
                            {{ optional($grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom)->name ?? '' }}
                            -
                            {{ optional($grade->teacherClassroomRelationship->teacherSubjectRelationship->teacher)->name ?? '' }}
                            -
                            {{ optional($grade->teacherClassroomRelationship->teacherSubjectRelationship->subject)->name ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="student_id" id="student_id"
                    class="form-control data-select-2 @error('student_id') is-invalid @enderror">
                    <option value="">All Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}"
                            {{ request('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
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
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Grade</th>
                    <th>Student</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gradeDetails as $index => $gradeDetail)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            {{ optional($gradeDetail->grade->taskType)->name ?? '' }} -
                            {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom)->classroomType->name ?? '' }}
                            -
                            {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom)->name ?? '' }}
                            -
                            {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherSubjectRelationship->teacher)->name ?? '' }}
                            -
                            {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherSubjectRelationship->subject)->name ?? '' }}
                        </td>
                        <td class="text-center">{{ optional($gradeDetail->student)->name }}</td>
                        <td class="text-center">{{ $gradeDetail->value }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Grade Detail Actions">
                                @if (Auth::user()->role == 'Teacher')
                                    <a href="{{ route('grade-detail.edit', $gradeDetail->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('grade-detail.destroy', $gradeDetail->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this grade detail?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
    </div>
</div>
@endsection
