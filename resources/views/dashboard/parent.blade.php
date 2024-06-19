@extends('layouts.main')
@section('container')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Welcome {{ Auth::user()->name }}!</h3>
        </div>
        <div class="card-body">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card text-white mb-3" style="background-color: #dee2e6; #3D5EE1;">
                        <div class="card-body" style="border: 3px solid #3D5EE1; border-radius: 0.25rem;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center" style="width: 100%">
                                    <h5 class="card-title">Schedules</h5>
                                </div>
                            </div>
                            @if ($schedules->isEmpty())
                                <p class="text-muted mt-3">No schedules available for your children.</p>
                            @else
                                @foreach ($schedules as $schedule)
                                    <div class="mb-4">
                                        <h5>{{ $schedule->schedule_day }}</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Subject</th>
                                                        <th>Teacher</th>
                                                        <th>Start Time</th>
                                                        <th>End Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $schedule->subject_name }}</td>
                                                        <td>{{ $schedule->teacher_name }}</td>
                                                        <td>{{ $schedule->schedule_time_start }}</td>
                                                        <td>{{ $schedule->schedule_time_end }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->role != 'Admin')
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card text-white mb-3">
                            <div class="card-body" style="border: 3px solid #3D5EE1; border-radius: 0.25rem;">
                                <div class="d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #dee2e6; padding: 10px;">
                                    <div class="text-center" style="width: 100%">
                                <h5 class="card-title text-black">Child Information</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <td>{{ $parent->child->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <td>{{ $parent->child->email }}</td>
                                            </tr>
                                            <tr>
                                                <th>Class</th>
                                                <td>
                                                    @if ($parent->child->studentTeacherHomeroom && $parent->child->studentTeacherHomeroom->teacherHomeroomRelationship && $parent->child->studentTeacherHomeroom->teacherHomeroomRelationship->classroom)
                                                        {{ $parent->child->studentTeacherHomeroom->teacherHomeroomRelationship->classroom->name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Homeroom Teacher</th>
                                                <td>
                                                    @if ($parent->child->studentTeacherHomeroom && $parent->child->studentTeacherHomeroom->teacherHomeroomRelationship && $parent->child->studentTeacherHomeroom->teacherHomeroomRelationship->teacher)
                                                        {{ $parent->child->studentTeacherHomeroom->teacherHomeroomRelationship->teacher->name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Roll Number</th>
                                                <td>{{ $parent->child->identity_number }}</td>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $parent->child->phone }}</td>
                                            </tr>
                                            <tr>
                                                <th>Gender</th>
                                                <td>{{ $parent->child->gender }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth</th>
                                                <td>{{ $parent->child->born_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Current Address</th>
                                                <td>{{ $parent->child->address }}</td>
                                            </tr>
                                            <tr>
                                                <th>Student's Parent</th>
                                                <td>{{ $parent->child->parent ? $parent->child->parent->name : 'N/A' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
