@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ route('teacher-subject.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table border-0 star-teacher-subject table-hover table-center mb-0 table-striped">
        <thead class="teacher-subject-thread">
            <tr class="text-center">
                <th>Id</th>
                <th>Teacher</th>
                <th>Subject</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher_subjects as $index => $teacher_subject)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $teacher_subject->teacher->name }}</td>
                <td class="text-center">{{ $teacher_subject->subject->name }} - {{ $teacher_subject->subject->name }}</td>
                <td class="align-middle text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('teacher-subject.edit', $teacher_subject->id) }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('teacher-subject.destroy', $teacher_subject->id) }}">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin mau menghapus {{ $teacher_subject->teacher->name}} ?')">

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
