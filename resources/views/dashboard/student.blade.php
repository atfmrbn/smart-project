@extends('layouts.main')
@section('title', $title)
@section('container')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header">
                @if (Auth::user()->role == 'Admin')
                    <h3 class="mb-0">Admin Dashboard</h3>
                @else
                    <h3 class="mb-0">Welcome to your Student Dashboard, {{ Auth::user()->name }}!</h3>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="card-title">Book Borrowing</strong>
                                        <h3 class="card-text text-white">{{ $studentBorrowCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-book-reader fa-2x"></i>
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
                                        <strong class="card-title">Book Returned</strong>
                                        <h3 class="card-text text-white">{{ $studentReturnedCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-book-reader fa-2x"></i>
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
                                        <strong class="card-title">Total Students</strong>
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
                                        <strong class="card-title">Subjects</strong>
                                        <h3 class="card-text text-white">{{ $subjectCount }}</h3>
                                    </div>
                                    <div>
                                        <i class="fas fa-book fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                @if (Auth::user()->role != 'Admin')
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $student->email }}</td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <td>
                                        @if (
                                            $student->studentTeacherHomeroom &&
                                                $student->studentTeacherHomeroom->teacherHomeroomRelationship &&
                                                $student->studentTeacherHomeroom->teacherHomeroomRelationship->classroom)
                                            {{ $student->studentTeacherHomeroom->teacherHomeroomRelationship->classroom->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Homeroom Teacher</th>
                                    <td>
                                        @if (
                                            $student->studentTeacherHomeroom &&
                                                $student->studentTeacherHomeroom->teacherHomeroomRelationship &&
                                                $student->studentTeacherHomeroom->teacherHomeroomRelationship->teacher)
                                            {{ $student->studentTeacherHomeroom->teacherHomeroomRelationship->teacher->name }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Roll Number</th>
                                    <td>{{ $student->identity_number }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $student->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $student->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{ $student->born_date }}</td>
                                </tr>
                                <tr>
                                    <th>Current Address</th>
                                    <td>{{ $student->address }}</td>
                                </tr>
                                <tr>
                                    <th>Student's Parent</th>
                                    <td><!-- Add parent's name here if needed --></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card text-white mb-3" style="background-color: #3D5EE1">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong class="card-title">Extracurricular Activities</strong>
                                            <h3 class="card-text text-white">{{ $extracurricularCount }}</h3>
                                        </div>
                                        <div>
                                            <i class="fas fa-user-graduate fa-2x"></i>
                                        </div>
                                    </div>
                                    <a href="#" class="small-box-footer text-white" data-toggle="modal"
                                        data-target="#extracurricularModal">More
                                        info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-card"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if (Auth::user()->role != 'Admin')
        <!-- Modal -->
        <div class="modal fade" id="extracurricularModal" tabindex="-1" role="dialog"
            aria-labelledby="extracurricularModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="extracurricularModalLabel">Your Extracurricular Activities</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            @forelse($extracurriculars as $extra)
                                <li class="list-group-item">
                                    <h5>{{ $extra->extracurricular_name }}</h5>
                                    <p>{{ $extra->extracurricular_description }}</p>
                                </li>
                            @empty
                                <li class="list-group-item">You are not enrolled in any extracurricular activities.</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Include FullCalendar CSS and JS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                initialDate: '{{ date('Y-m-d') }}', // Set the current date
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [{
                        title: 'Meeting with teacher',
                        start: '2024-06-12'
                    },
                    {
                        title: 'Project due date',
                        start: '2024-06-15'
                    }
                    // Add more events as needed
                ]
            });

            calendar.render();
        });
    </script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12" style="size: 70%">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
@endsection
