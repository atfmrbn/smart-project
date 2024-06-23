@extends('layouts.main')
@section('title', $title)
@section('container')
    {{-- <div class="container mt-5"> --}}
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent; border: none;">
                @if (Auth::user()->role == 'Student')
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Student Dashboard</li>
                @endif
            </ol>
        </nav>
        {{-- <div class="card shadow-sm"> --}}
            <div class="card-header">
                @if (Auth::user()->role == 'Student')
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
                    {{-- <div class="col-lg-6 col-sm-6">
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
                    </div> --}}
                    <div class="col-lg-6 col-sm-6">
                        <div class="card text-white mb-3" style="background-color: #3D5EE1; height: 127px">
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
                    <div class="col-lg-6 col-sm-6">
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
                <!-- Teacher Schedules Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card text-white mb-3">
                            <div class="card-body" style="border: 1px solid #dee2e6; border-radius: 0.25rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <div class="d-flex justify-content-between align-items-center"
                                    style="border-bottom: 1px solid #dee2e6; padding: 10px;">
                                    <div class="text-center" style="width: 100%">
                                        <h5 class="card-title">Schedules</h5>
                                    </div>
                                </div>
                                @if ($teacherSchedules->isEmpty())
                                    <p>No schedules available for your class.</p>
                                @else
                                    @foreach ($teacherSchedules as $day => $schedules)
                                        <h5>{{ $day }}</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Teacher</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($schedules as $schedule)
                                                        <tr>
                                                            <td>{{ $schedule->teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
                                                            </td>
                                                            <td>{{ $schedule->teacherClassroomRelationship->teacherSubjectRelationship->teacher->name }}
                                                            </td>
                                                            <td>{{ $schedule->schedule_time_start }}</td>
                                                            <td>{{ $schedule->schedule_time_end }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


                @if (Auth::user()->role != 'Admin')
                    <div class="table-responsive" style="border-radius: 0.25rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <table class="table table-bordered">
                            <tbody>
                                {{-- <tr>
                                    <th>Name</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $student->email }}</td>
                                </tr> --}}
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
                                    <th>Identity Number</th>
                                    <td>{{ $student->identity_number }}</td>
                                </tr>
                                {{-- <tr>
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
                                    <td>{{ $student->parent ? $student->parent->name : 'N/A' }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="col-12 mt-5 p-3" style="border-radius: 0.25rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div id='calendar' class="equal-height"></div>
                </div>
            </div>
        {{-- </div> --}}
    {{-- </div> --}}

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
