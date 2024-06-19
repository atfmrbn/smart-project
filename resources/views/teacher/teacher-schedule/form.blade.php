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
            <li class="breadcrumb-item"><a href="{{ URL::to('/teacher/teacher-schedule') }}">Teacher
                    Schedules</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($teacherSchedule))
        <form method="POST" action="{{ route('teacher-schedule.update', $teacherSchedule->id) }}" autocomplete="off">
            @method('PUT')
        @else
            <form method="POST" action="{{ route('teacher-schedule.store') }}" autocomplete="off">
    @endif
    @csrf

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group local-forms">
                <label for="teacher_classroom_relationship_id">Teacher Classroom <span class="login-danger">*</span></label>
                <select name="teacher_classroom_relationship_id" id="teacher_classroom_relationship_id"
                    class="form-control data-select-2 @error('teacher_homeroom_relationship_id') is-invalid @enderror"
                    value="7">
                    @foreach ($teacherClassroomRelationships as $teacherClassroomRelationship)
                        <option value="{{ $teacherClassroomRelationship->id }}"
                            {{ isset($teacherSchedule) && $teacherSchedule->teacher_classroom_relationship_id == $teacherClassroomRelationship->id ? 'selected' : '' }}>
                            {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }}
                            -
                            {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }}-{{ $teacherClassroomRelationship->TeacherSubjectRelationship->teacher->name }}-{{ $teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_classroom_relationship_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group local-forms">
                <label for="schedule_day">Teacher Schedule Day <span class="login-danger">*</span></label>
                <select name="schedule_day" id="schedule_day"
                    class="form-control data-select-2 @error('schedule_day') is-invalid @enderror">
                    <option value="Senin"
                        {{ isset($teacherSchedule) && $teacherSchedule->schedule_day == 'Senin' ? 'selected' : '' }}>Senin
                    </option>
                    <option value="Selasa"
                        {{ isset($teacherSchedule) && $teacherSchedule->schedule_day == 'Selasa' ? 'selected' : '' }}>
                        Selasa</option>
                    <option value="Rabu"
                        {{ isset($teacherSchedule) && $teacherSchedule->schedule_day == 'Rabu' ? 'selected' : '' }}>Rabu
                    </option>
                    <option value="Kamis"
                        {{ isset($teacherSchedule) && $teacherSchedule->schedule_day == 'Kamis' ? 'selected' : '' }}>Kamis
                    </option>
                    <option value="Jumat"
                        {{ isset($teacherSchedule) && $teacherSchedule->schedule_day == 'Jumat' ? 'selected' : '' }}>Jumat
                    </option>
                    <option value="Sabtu"
                        {{ isset($teacherSchedule) && $teacherSchedule->schedule_day == 'Sabtu' ? 'selected' : '' }}>Sabtu
                    </option>
                </select>
                @error('schedule_day')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group local-forms">
                <label for="schedule_time_start">Teacher Schedule Time Start <span class="login-danger">*</span></label>
                <input class="form-control @error('schedule_time_start') is-invalid @enderror" type="time"
                    name="schedule_time_start"
                    value="{{ isset($teacherSchedule) ? DateFormat($teacherSchedule->schedule_time_start, 'HH:mm') : '' }}" />
                @error('schedule_time_start')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group local-forms">
                <label for="schedule_time_end">Teacher Schedule Time End <span class="login-danger">*</span></label>
                <input class="form-control @error('schedule_time_end') is-invalid @enderror" type="time"
                    name="schedule_time_end"
                    value="{{ isset($teacherSchedule) ? DateFormat($teacherSchedule->schedule_time_end, 'HH:mm') : '' }}" />
                @error('schedule_time_end')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <div class="col-12">
            <div class="teacher_classroom-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('teacher-schedule.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
    </form>
@endsection
