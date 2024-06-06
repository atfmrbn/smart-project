@extends("layouts.main")
@section("container")


<div class="page-header">
    <div class="row align-items-center">
        <div class="col mb-3">
            <h3 class="page-title">{{ $title }}</h3>
        </div>

        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
        </div>

        <form action="{{ URL::to('book-return') }}" method="GET">
            <div class="row">
                <div class="col-2">
                    <div class="form-group">
                        <label for="startDate">From:</label>
                        <input type="date" id="startDate" name="startDate" class="form-control" value="{{ request('startDate') }}">               
                        <button type="submit" class="btn btn-primary mt-2">Filter</button>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group">
                        <label for="endDate">To:</label>
                        <input type="date" id="endDate" name="endDate" class="form-control" value="{{ request('endDate') }}">               
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="student-thread">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Patron</th>
                <th class="text-center">Checkout Date</th>
                <th class="text-center">Due Date</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($filterByDate) && $filterByDate->isNotEmpty())
                @foreach ($filterByDate as $index => $filter)
                    <tr class="align-middle">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $filter->name }} - ({{ $filter->identity_number }}) - {{ $filter->classroom_name }}</td>
                        <td>{{ $filter->checkout_date }}</td>
                        <td>{{ $filter->due_date }}</td>
                        <td>{{ $filter->status }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <form method="POST" action="{{ URL::to('book-return/' . $filter->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Anda yakin mau menghapus peminjaman buku oleh {{ $filter->name }} ?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No data available</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

@endsection