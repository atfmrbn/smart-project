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
            {{-- <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a> --}}
            <a href="{{ route('tuition-type.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New</a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="table table-bordered table-striped">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tuitionTypes as $index => $tuitionType)
                <tr class="align-middle">
                    <td class="text-center" style="width:10%">{{ $index + 1 }}</td>
                    <td>{{ $tuitionType->name }}</td>
                    <td class="align-middle text-center" style="width:20%">
                        <div class="d-flex justify-content-center align-items-center">
                            {{-- <a title="Lihat" href="{{ URL::to('tuition-type/' . $tuitionType->id) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a> --}}
                            <a title="Edit" href="{{ URL::to('tuition-type/' . $tuitionType->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ URL::to('tuition-type/' . $tuitionType->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $tuitionType->name }}?')">
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
