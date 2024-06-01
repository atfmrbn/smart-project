@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('book-return/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    </div>

<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="student-thread">
            <tr>
                <th class="text-center">No</th>
                <th>Patron</th>
                {{-- <th>Description</th> --}}
                <th>Checkout Date</th>
                <th>Due Date</th>
                {{-- <th>Returned Date</th> --}}
                {{-- <th>Penalty</th> --}}
                <th class="text-center">Action</th>
            </tr>
        </thead>
        @foreach ($returns as $index => $return)
            <tr class="align-middle">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $return->classroom_name }} - {{ $return->identity_number }}  - {{ $return->name }}</td>
                {{-- <td>{{ $return->description }}</td> --}}
                <td>{{ $return->checkout_date }}</td>
                <td>{{ $return->due_date }}</td>
                {{-- <td>{{ $return->borrowingBook->returned_date }}</td> --}}
                {{-- <td>{{ $borrow->returned_date }}</td> --}}
                <td class=" text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        {{-- <a href="{{ route('book-borrow.edit', $return->id) }}" title="Edit" class="btn btn-sm btn-outline-primary me-2">
                            <i class="fas fa-edit"></i>
                        </a> --}}
                        <form method="POST" action="{{ URL::to('book-borrow/' . $return->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Anda yakin mau menghapus peminjaman buku oleh {{ $return->user->name }} ?')">
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
