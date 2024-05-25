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
    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
        <thead class="student-thread">
            <tr>
                <th>ID</th>
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
