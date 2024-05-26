@extends('layouts.main')
@section('container')

@if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif

<a href="{{ URL::to('teacher/teacher-list/add') }}" class="btn btn-success mb-3">Add</a>


<table id="datatable1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width=5%>No</th>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Born Date</th>
            <th>Phone</th>
            <th>NIK</th>
            <th>Address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->born_date }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->NIK }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    <div class="d-flex">
                    <a href="{{ URL::to('user/' . $user->id) }}" class="btn btn-sm btn-info mr-4">Show</a>
                    <a href="{{ URL::to('user/' . $user->id. '/edit') }}" class="btn btn-sm btn-warning mr-4">Edit</a>
                    <form action="{{ URL::to('user/' . $user->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin mau menghapus data ini {{ $user->name }}?')">Delete</button>
                    </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
