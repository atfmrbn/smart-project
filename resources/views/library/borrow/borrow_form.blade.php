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
                        {{ $student->id }} - {{ $student->name }}
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
    <div class="col-md-5 border">
        <div class="row">
            @foreach($books as $book)
            <div class="col-md-4 mb-4 d-flex align-items-stretch mt-2">
                <div class="card" style="width: 100%;">
                    <img class="card-img-top card-img-fixed" src="{{ asset('storage/' . $book->image) }}" alt="Image Menu">
                    <div class="card-body d-flex flex-column">
                        <p>{{ $book->title }}</p>
                        <form action="{{ route('book-borrow-detail.store') }}" method="POST" autocomplete="off" class="mt-auto">
                            @csrf
                            <input type="hidden" name="borrowing_book_id" value="{{ $borrow->id }}">
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <button type="submit" class="btn btn-primary btn-block">Select</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-7 border ">
        {{-- <table class="table table-bordered table-striped mt-2 table-responsive"> --}}
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center">No</th>
                    <th style="text-align: center">Book</th>
                    <th style="text-align: center">Category</th>
                    <th style="width: 10%; text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrow->borrowDetail as $index => $borrowDetail)
                <tr>
                    <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                    <td class="align-middle">{{ $borrowDetail->book->title }}</td>
                    <td class="align-middle">{{ $borrowDetail->book->category->name }}</td>
                    <td class="align-middle">
                        <div class="text-center">
                            {{-- <a href="{{ URL::to('book-borrow/' . $borrowDetail->id . '/edit') }}" class="btn btn-sm btn-outline-primary ms-2"><i class="fas fa-edit"></i></a> --}}

                            <form method="POST" action="{{ route('book-borrow-detail.destroy', $borrowDetail->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Anda yakin mau menghapus detail peminjaman untuk buku {{ $borrowDetail->book->title }}?')"><i class="fas fa-trash"></i></button>
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