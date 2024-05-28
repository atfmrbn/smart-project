@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
            <a href="{{ URL::to('book-borrow/add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="student-thread">
            <tr>
                <th>No</th>
                <th>Patron</th>
                <th>Description</th>
                <th>Checkout Date</th>
                <th>Due Date</th>
                <th>Penalty</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>

@endsection
