@extends("layouts.main")
@section('container')


<h5>{{ isset($borrow) ? 'Edit' : 'Add' }} Borrowing Book</h5>
<br>
@if(isset($borrow))
<form method="POST" action="{{ route('book-borrow.update', $borrow->id) }}" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf
@else
<form action="{{ route('book-borrow.store') }}" method="POST" autocomplete="off">
@endif
    @csrf
    <div class="row">
    <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="student_id">Patron <span class="login-danger">*</span></label>
            <select name="student_id" id="student_id" class="form-control data-select-2">
                <option value="">Select Patron</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ (isset($borrow) && $borrow->student_id == $student->id) ? 'selected' : '' }}>
                        {{ $student->classroom_name }} - {{ $student->identity_number }}  - {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="description">Description <span class="login-danger">*</span></label>
            <input type="text" id="description" name="description" class="form-control" value="{{ isset($borrow) ? $borrow->description : old('description') }}" placeholder="Add description">
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="checkout_date">Checkout Date <span class="login-danger">*</span></label>
            <input type="date" id="checkout_date" name="checkout_date" class="form-control" value="{{ isset($borrow) ? $borrow->checkout_date : old('checkout_date') }}">
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="due_date">Due Date <span class="login-danger">*</span></label>
            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ isset($borrow) ? $borrow->due_date : old('due_date') }}">
        </div>
    </div>
    
    <div class="col-12">
        <div class="student-submit">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>

</form>


@if(isset($borrow))
<hr class="mt-4">
<h5 class="mt-5">Book Borrowing Details</h5>

{{-- @if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif --}}

<div class="row">
    {{-- <div class="col-md-5 border">
        <div class="row"> --}}
        <form action="{{ route('book-borrow-detail.store') }}" method="POST" autocomplete="off" class="mt-4">
            @csrf
            <input type="hidden" name="borrowing_book_id" value="{{ $borrow->id }}">
            <select name="book_id" id="book_id" class="form-control data-select-2">
                <option value="">ISBN - Cateogry - Title</option>
                @foreach ($books as $book)
                    <option value="{{ $book->id }}">
                        {{ $book->isbn }} - {{ $book->category->name }}  - {{ $book->title }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-block">Select</button>
        </form>
        {{-- </div> --}}
    {{-- </div> --}}

    <div class="col-md-12 mt-5">
        {{-- <table class="table table-bordered table-striped mt-2 table-responsive"> --}}
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center">No</th>
                    <th style="text-align: center">Book</th>
                    <th style="text-align: center">Category</th>
                    <th style="text-align: center">Returned</th>
                    <th style="text-align: center">Penalty</th>
                    <th style="width: 10%; text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrow->borrowDetail as $index => $borrowDetail)
                <tr>
                    <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                    <td class="align-middle">{{ $borrowDetail->book->title }}</td>
                    <td class="align-middle">{{ $borrowDetail->book->category->name }}</td>
                    <td class="align-middle" style="text-align: center;">
                        @if($borrowDetail->returned_date)
                            <span class="badge bg-success">Returned</span>
                        @else
                            <span class="badge bg-warning">Not Returned</span>
                        @endif
                    </td>
                    <td class="align-middle" style="text-align: center;">
                        {{ $borrowDetail->penalty ? 'Rp. ' . number_format($borrowDetail->penalty, 0, ',', '.') : 'No Penalty' }}
                    </td>
                    <td class="align-middle">
                        <div class="text-center">
                            <form method="POST" action="{{ route('book-borrow-detail.return', $borrowDetail->id) }}">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm('Anda yakin mau mengembalikan buku ini?')" {{ $borrowDetail->returned_date ? 'disabled' : '' }}>
                                    <i class="fas fa-book"></i> Return
                                </button>
                            </form>
                            <form method="POST" action="{{ route('book-borrow-detail.destroy', $borrowDetail->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin mau menghapus detail peminjaman untuk buku {{ $borrowDetail->book->title }}?')" {{ $borrowDetail->returned_date ? 'disabled' : '' }}>
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
</div>
@endif


@endsection