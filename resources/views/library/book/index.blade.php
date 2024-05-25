@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('book/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
        <thead class="student-thread">
            <tr class="text-center">
                <th>#</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $index => $book)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->publisher }}</td>
                <td>{{ $book->description }}</td>
                <td>
                    @if ($book->status == "available")
                        <span class="badge badge-success">Available</span>
                    @else
                        <span class="badge badge-danger">Unavailable</span>
                    @endif
                </td>
                <td class="align-middle text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ URL::to('library/edit-book/'.$book->id) }}" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ URL::to('book/' . $book->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin mau menghapus buku {{ $book->title }} ?')">
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
