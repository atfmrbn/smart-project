@extends('layouts.main')
@section('container')

@if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('curriculum/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="datatable1" class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Year</th>
                <th>Description</th>
                {{-- <th>Created At</th>
                <th>Updated At</th> --}}
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($curriculums as $index => $curriculum)
                <tr class="text-center">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $curriculum->year }}</td>
                    <td>{{ $curriculum->description }}</td>
                    {{-- <td>{{ $curriculum->created_at }}</td>
                    <td>{{ $curriculum->updated_at }}</td> --}}
                    <td class="align-middle text-center">
                        <div class="d-flex justify-content-center align-items-center">
                        <a title="Lihat" href="{{ URL::to('curriculum/' . $curriculum->id) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                        <a href="{{ URL::to('curriculum/' . $curriculum->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ URL::to('curriculum/' . $curriculum->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $curriculum->name }}?')">
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
