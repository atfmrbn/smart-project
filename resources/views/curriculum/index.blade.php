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

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            <div class="col-auto text-end float-end ms-auto download-grp">
                <a href="{{ route('curriculum.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Add New</a>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Year</th>
                    <th>Description</th>
                    <th>Is Default</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($curriculums as $index => $curriculum)
                    <tr class="text-center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $curriculum->year }}</td>
                        <td>{{ $curriculum->description }}</td>
                        <td>{{ $curriculum->is_default ? 'Default' : '' }}</td>
                        <td class="align-middle text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <a title="Lihat" href="{{ URL::to('curriculum/' . $curriculum->id) }}"
                                    class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a>
                                <a title="Edit" href="{{ URL::to('curriculum/' . $curriculum->id . '/edit') }}"
                                    class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                                <form action="{{ URL::to('curriculum/' . $curriculum->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger me-2"
                                        onclick="return confirm('Anda yakin mau menghapus data ini {{ $curriculum->name }}?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <form action="{{ route('curriculum.setDefault', $curriculum->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" title="Default" class="btn btn-sm btn-outline-warning me-2"
                                        {{ $curriculum->is_default ? '' : '' }}>
                                        <i class="fas fa-check"></i> {{ $curriculum->is_default ? '' : '' }}
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
