@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('teacher-classroom/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table border-0 star-teacher-classroom table-hover table-center mb-0 datatable table-striped">
        <thead class="teacher-classroom-thread">
            <tr class="text-center">
                <th>Id</th>
                <th>Teacher</th>
                <th>Classroom</th>
                <th>Curriculum</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher_classrooms as $index => $teacher_classroom)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $teacher_classroom->teacher->name }}</td>
                <td class="text-center">{{ $teacher_classroom->classroom->classroomType->name }} - {{ $teacher_classroom->classroom->name }}</td>
                <td class="text-center">{{ $teacher_classroom->curriculum->year }}</td>
                <td class="text-center">{{ $teacher_classroom->subject->subject }}</td>
                <td class="align-middle text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('teacher-classroom.edit', $teacher_classroom->id) }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('teacher-classroom.destroy', $teacher_classroom->id) }}">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin ingin menghapus data ini? {{ $teacher_classroom->teacher->name}} ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection