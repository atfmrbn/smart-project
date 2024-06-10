@extends('layouts.main')
@section('container')

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">Grades</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ route('teacher-grade.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table border-0 star-grades table-hover table-center mb-0 datatable table-striped">
        <thead class="grades-thread">
            <tr class="text-center">
                <th>Id</th>
                <th>Task Type</th>
                <th>Student Teacher Homeroom</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $index => $grade)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $grade->taskType }}</td>
                <td class="text-center">{{ $grade->studentTeacherHomeroomRelationship->student->name }} - {{ $grade->studentTeacherHomeroomRelationship->teacherHomeroom->name }}</td>
                <td class="text-center">{{ $grade->value }}</td>
                <td class="align-middle text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('teacher-grade.edit', $grade->id) }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('teacher-grade.destroy', $grade->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this grade?')">
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
