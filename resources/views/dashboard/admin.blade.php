@extends('layouts.main')
@section('title', $title)
@section('container')
    <div class="container mt-5">
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent; border: none;">
                @if (Auth::user()->role == 'Admin')
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                @endif
            </ol>
        </nav>
        <div class="card shadow-sm">
            <div class="card-header">
                @if (Auth::user()->role == 'Admin')
                    <h3 class="mb-0">Welcome to your Admin Dashboard, {{ Auth::user()->name }}!</h3>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Admins</strong>
                                        <h3 class="card-text text-white">{{ $adminCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Teachers</strong>
                                        <h3 class="card-text text-white">{{ $teacherCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/teacher/teacher-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('teacher/teacher-list') ? 'active' : '' }} }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Students</strong>
                                        <h3 class="card-text text-white">{{ $studentCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/student/student-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('student/student-list') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Parents</strong>
                                        <h3 class="card-text text-white">{{ $parentCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/parent/parent-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('parent/parent-list') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Librarians</strong>
                                        <h3 class="card-text text-white">{{ $librarianCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('librarian/librarian-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('librarian/librarian-list') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Classrooms</strong>
                                        <h3 class="card-text text-white">{{ $classroomCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('classroom/') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('classroom') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Subjects</strong>
                                        <h3 class="card-text text-white">{{ $subjectCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-book fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/subject') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('subject') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->role == 'Admin')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $admin->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $admin->email }}</td>
                                </tr>
                                <tr>
                                    <th>Roll Number</th>
                                    <td>{{ $admin->identity_number }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $admin->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $admin->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{ $admin->born_date }}</td>
                                </tr>
                                <tr>
                                    <th>Current Address</th>
                                    <td>{{ $admin->address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
