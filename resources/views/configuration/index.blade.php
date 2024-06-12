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

<div class="row">
    @foreach ($configurations as $index => $configuration)
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $configuration->name }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" class="form-control" value="{{ $configuration->address }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ $configuration->phone }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ $configuration->email }}" readonly>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <label for="book_penalty">Penalty</label>
                <input type="text" id="book_penalty" name="book_penalty" class="form-control" value="{{ $configuration->book_penalty }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="d-flex justify-content-start align-items-center">
                    <a href="{{ URL::to('configuration/' . $configuration->id. '/edit') }}" class="btn btn-outline-primary me-2"><i class="fas fa-edit"></i> Edit</a>
                    <form action="{{ URL::to('configuration/' . $configuration->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger me-2" onclick="return confirm('Anda yakin mau menghapus data ini {{ $configuration->name }}?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- <div class="table-responsive">
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
                        {{-- <a title="Edit" href="{{ URL::to('configuration/' . $configuration->id. '/edit') }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i></a>
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
</div> --}}

@endsection
