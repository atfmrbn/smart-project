@extends('layouts.main')
@section('container')
    {{-- <div class="container mt-5"> --}}
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent; border: none;">
                @if (Auth::user()->role == 'Admin')
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                @endif
            </ol>
        </nav>
        {{-- <div class="card shadow-sm"> --}}
            <div class="card-header">
                @if (Auth::user()->role == 'Admin')
                    <h3 class="mb-0">Welcome to your Admin Dashboard, {{ Auth::user()->name }}!</h3>
                @endif
            </div>
            <div class="card-body">
                <div class="row mt-5">
                    <div class="col-lg-3 col-sm-4">
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
                    <div class="col-lg-3 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Teachers</strong>
                                        <h3 class="card-text text-white">{{ $teacherCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-chalkboard-teacher fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/teacher/teacher-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('teacher/teacher-list') ? 'active' : '' }} }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Students</strong>
                                        <h3 class="card-text text-white">{{ $studentCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-graduation-cap fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/student/student-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('student/student-list') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4">
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
                    <div class="col-lg-3 col-sm-4">
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
                                {{-- <a href="{{ URL::to('librarian/librarian-list') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('librarian/librarian-list') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-4">
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
                    <div class="col-lg-3 col-sm-4">
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
                    <div class="col-lg-3 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Tuition</strong>
                                        <h3 class="card-text text-white">{{ $tuitionCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-money-bill-wave fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/tuition') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('tuition') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-sm-4">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 133px">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Curriculums</strong>
                                        <h3 class="card-text text-white">{{ $curriculumCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-school fa-2x"></i>
                                    </div>
                                </div>
                                <a href="{{ URL::to('/years') }}"
                                    class="small-box-footer text-white mt-2 {{ request()->is('years') ? 'active' : '' }}">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="row mt-5">
                    <div class="col-lg-6 col-sm-12">
                        <div class="card mb-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="card-header" style="background-color: #3d5ee1ee; color:white"><strong>Overview</strong></div>
                            <div class="card-body" style="background-color: #f8f9fa;">
                                <canvas id="combinedChart1" class="equal-height"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="card mb-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="card-header" style="background-color: #3d5ee1ee; color:white"><strong>Calendar</strong></div>
                            <div class="card-body" style="background-color: #f8f9fa;">
                                <div id='calendar' class="equal-height"></div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- @if (Auth::user()->role == 'Admin')
                    <div class="table-responsive mt-5">
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
                @endif --}}
            </div>
        {{-- </div> --}}
    {{-- </div> --}}

    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet' />
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>

    <style>
        .equal-height {
            height: 100%;
            /* Adjust the height as needed */
        }

        .row.equal-height {
            display: flex;
            height: 600px;
            /* Adjust this value as needed */
        }

        .col-6 {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Align items vertically centered if needed */
        }

        .canvas-container,
        #calendar {
            flex: 1;
        }
    </style>
    <script>
        var ctx = document.getElementById('combinedChart1').getContext('2d');
        var combinedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Teachers', 'Students', 'Librarians', 'Parents'],
                datasets: [{
                    label: 'Users',
                    data: [{{ $teacherCount }}, {{ $studentCount }}, {{ $librarianCount }},
                        {{ $parentCount }}
                    ],
                    backgroundColor: [
                        '#3D5EE1'
                    ],
                    borderColor: [
                        '#3D5EE1'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        maintainAspectRatio: false,
                        // max: 20 // Setting the upper limit of the y-axis to 20
                    }
                },
                plugins: {
                    legend: {
                        position: 'none', // Posisi legenda di atas grafik
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw;
                                return label;
                            }
                        }
                    }
                },
            }
        });
        // FullCalendar Initialization
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true,
                events: [
                    // Fetch events dynamically from your database or add static events here
                    {}
                ],
                selectable: true,
                select: function(info) {
                    var title = prompt('Enter Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: info.startStr,
                            end: info.endStr
                        };
                        calendar.addEvent(eventData);
                        // Optionally, save the event to your database via AJAX
                    }
                    calendar.unselect();
                },
                eventClick: function(info) {
                    if (confirm("Are you sure you want to delete this event?")) {
                        info.event.remove();
                        // Optionally, remove the event from your database via AJAX
                    }
                }
            });
            calendar.render();
        });
    </script>

@endsection
