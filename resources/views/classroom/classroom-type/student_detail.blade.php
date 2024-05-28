@extends("layouts.main")
@section("container")

<div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
        </div>
        <div class="col-auto text-end float-end ms-auto download-grp">
            <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
        <thead class="student-thread">
            <tr class="text-center">
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classroom_types as $index => $classroom_type)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $classroom_type->name }}</td>
                <td>{{ $classroom_type->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
