@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('teacher/teacher-schedule/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<form id="filterForm" method="GET" action="{{ route('teacher-schedule.index') }}">
    <div class="row mb-3">
        <div class="col-md-5">
            <select name="teacher_classroom_relationship_id" id="teacher_classroom_relationship_id" class="form-control  data-select-2">
                <option value="" {{ request('teacher_classroom_relationship_id') == "" ? 'selected' : '' }}>All Classes</option>               
                @foreach ($teacherClassroomRelationships as $teacherClassroomRelationship)
                    <option value="{{ $teacherClassroomRelationship->id }}" {{ request('teacher_classroom_relationship_id') == $teacherClassroomRelationship->id ? 'selected' : '' }}>
                        {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }} - 
                {{ $teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }}-{{ $teacherClassroomRelationship->TeacherSubjectRelationship->teacher->name }}-{{ $teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
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
            <th>No</th>
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
            <td>{{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }}-{{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }}  </td>
            <td>{{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->teacher->name }}-{{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}  </td>            
            <td>{{ $teacherSchedule->schedule_day }} {{ DateFormat($teacherSchedule->schedule_time_start, "HH:mm") }}-{{ DateFormat($teacherSchedule->schedule_time_end, "HH:mm") }}</td>
            <td class="align-middle text-center">
                <div class="d-flex justify-content-center align-items-center">
                    <a href="{{ route('teacher-schedule.edit', $teacherSchedule->id) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('teacher-schedule.destroy', $teacherSchedule->id) }}">
                        @csrf
                        @method('delete')
                        <button title="Delete" type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
