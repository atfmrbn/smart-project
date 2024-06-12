@extends("layouts.main")
@section('title', $title)
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="{{ URL::to('book-borrow-download') }}" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('book-borrow/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="student-thread">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Patron</th>
                <th class="text-center">Description</th>
                <th class="text-center">Checkout Date</th>
                <th class="text-center">Due Date</th>
                {{-- <th class="text-center">Penalty</th> --}}
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $index => $borrow)
            <tr class="align-middle">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $borrow->classroom_name }} - {{ $borrow->identity_number }}  - {{ $borrow->name }}</td>
                <td>{{ $borrow->description }}</td>
                <td>{{ DateFormat($borrow->checkout_date, "DD MMMM Y") }}</td>
                <td>{{ DateFormat($borrow->due_date, "DD MMMM Y") }}</td>
                {{-- <td>{{ $borrow->returned_date }}</td> --}}
                <td class=" text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <a href="{{ route('book-borrow.edit', $borrow->id) }}" title="Edit" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ URL::to('book-borrow/' . $borrow->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Anda yakin mau menghapus peminjaman buku oleh {{ $borrow->user->name }} ?')">
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
