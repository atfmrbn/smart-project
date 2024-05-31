@extends('layouts.main')
@section('container')
    {{-- @if (session()->has('successMessage'))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if (session()->has('errorMessage'))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif --}}

    <a href="{{ URL::to('classroom/create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus" aria-hidden="true"></i> Add</a>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th class="text-center">Classroom Type ID</th>
                    <th>Classroom Type Name</th>
                    <th>Name</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classrooms as $index => $classroom)
                    <tr>
                        <td class="align-middle">{{ $index + 1 }}</td>
                        <td class="align-middle text-center">{{ $classroom->classroom_type_id }}</td>
                        <td class="align-middle">{{ $classroom->classroomType->name }}</td>
                        <td class="align-middle">{{ $classroom->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a title="Lihat" href="{{ URL::to('classroom/' . $classroom->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                <a href="{{ URL::to('classroom/' . $classroom->id . '/edit') }}"
                                    class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                <form action="{{ URL::to('classroom/' . $classroom->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger me-2"
                                        onclick="return confirm('Anda yakin mau menghapus data ini {{ $classroom->name }} ?')"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection
