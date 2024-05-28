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
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>NIK</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->username }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->gender }}</td>
                <td>{{ $student->born_date }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->nik }}</td>
                <td>{{ $student->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
