@extends('layouts.main')
@section('container')
    @if (session()->has('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
    @endif

    @if (session()->has('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
    @endif

    <a href="{{ URL::to('extracurricular-student/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus" aria-hidden="true"></i> Add</a>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th>Student Name</th>
                    <th>Extracurricular Name</th>
                    <th>Description</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($extracurricular_students as $index => $extracurricular_student)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle">{{ $extracurricular_student->class_name }} - {{ $extracurricular_student->identity_number }}  - {{ $extracurricular_student->student_name }}</td>
                        <td class="align-middle">{{ $extracurricular_student->extracurricular_name }}</td>
                        <td class="align-middle">{{ $extracurricular_student->extracurricular_description }}</td>
                        <td>
                            <div class="d-flex">
                                <a title="View"
                                    href="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ URL::to('extracurricular-student/' . $extracurricular_student->id . '/edit') }}"
                                    class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                <form
                                    action="{{ URL::to('extracurricular-student/' . $extracurricular_student->id) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                        onclick="return confirm('Are you sure you want to delete this record {{ $extracurricular_student->student->name ?? 'N/A' }} ?')"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
