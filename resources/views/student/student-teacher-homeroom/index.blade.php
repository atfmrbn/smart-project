@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('student/student-teacher-homeroom/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Teacher Homeroom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentTeacherHomeroomRelationships as $index => $studentTeacherHomeroomRelationship)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $studentTeacherHomeroomRelationship->student->name }}</td>
                <td>{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content ">
                        <a title="Lihat" href="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                            <a title="Edit" href="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ URL::to('student/student-teacher-homeroom/' . $studentTeacherHomeroomRelationship->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $studentTeacherHomeroomRelationship->student->name }}?')">
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
