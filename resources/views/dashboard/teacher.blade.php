@extends('layouts.main')

@section('container')

{{-- <div class="container mt-5"> --}}
    {{-- <div class="card shadow-sm"> --}}
    <div class="container mt-5">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent; border: none;">
                @if (Auth::user()->role == 'Teacher')
                    <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Teacher Dashboard</li>
                @endif
            </ol>
        </nav>
        <div class="card-header">
            @if (Auth::user()->role == 'Admin')
                <h3 class="mb-0">Admin Dashboard</h3>
            @else
                <h2 class="mb-0">Welcome, {{ Auth::user()->name }}!</h2>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Students</strong>
                                    <h3 class="card-text text-white">{{ $studentCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-user-graduate fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Classrooms</strong>
                                    <h3 class="card-text text-white">{{ $teacherClassroomCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Subjects</strong>
                                    <h3 class="card-text text-white">{{ $teacherSubjectCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="card text-white mb-3" style="background-color: #3D5EE1">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="card-title">Total Attendance</strong>
                                    <h3 class="card-text text-white">{{ $attendanceCount }}</h3>
                                </div>
                                <div>
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center" style="width: 100%">
                                    <h3 class="card-title text-primary">Schedule List</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-primary">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Classroom</th>
                                            <th>Subject</th>            
                                            <th>Schedule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teacherSchedules as $index => $teacherSchedule)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }} - {{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }}</td>
                                                <td>{{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}</td>            
                                                <td>{{ $teacherSchedule->schedule_day }} {{ DateFormat($teacherSchedule->schedule_time_start, "HH:mm") }} - {{ DateFormat($teacherSchedule->schedule_time_end, "HH:mm") }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center" style="width: 100%">
                                    <h3 class="card-title text-primary">Class List</h3>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered text-primary">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Classroom</th>
                                            <th>Student Name</th>            
                                            <th>Schedule</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $index => $student)
                                            <tr class="text-center">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $student->classroom->classroomType->name ?? ''}} - {{ $student->classroom->name ?? ''}}</td>
                                                <td>{{ $student->name ?? '' }}</td>
                                                <td>{{ $student->schedule_day }} {{ DateFormat($student->schedule_time_start, "HH:mm") }} - {{ DateFormat($student->schedule_time_end, "HH:mm") }}</td>              
                                                <td>{{ $student->Attendance ?? '' }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- </div> --}}
{{-- </div> --}}



@endsection
