@extends("layouts.main")
@section("container")

@if (session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if (session()->has("errorMessage"))
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
            <a href="{{ URL::to('configuration/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table border-0 star-configuration table-hover table-center mb-0 datatable table-striped">
        <thead class="configuration-thread">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Penalty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($configurations as $index => $configuration)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $configuration->name }}</td>
                <td>{{ $configuration->address }}</td>
                <td>{{ $configuration->phone }}</td>
                <td>{{ $configuration->email }}</td>
                <td>{{ $configuration->book_penalty }}</td>
                <td class="align-middle text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        {{-- <a title="Lihat" href="{{ URL::to('configuration/' . $configuration->id) }}" class="btn btn-sm btn-outline-info me-2"><i class="fas fa-eye"></i></a> --}}
                        <a title="Edit" href="{{ URL::to('configuration/' . $configuration->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ URL::to('configuration/' . $configuration->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" title="Hapus" class="btn btn-sm btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $configuration->name }}?')">
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
