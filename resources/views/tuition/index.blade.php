@extends('layouts.main')
@section('container')

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Student')
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">{{ $title }}</h3>
            </div>
            @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin')
                <div class="col-auto text-end float-end ms-auto download-grp">
                    <a href="{{ URL::to('tuition/create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New</a>
                </div>
            @endif
        </div>
    </div>

    <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead class="student-thread">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Student</th>
                    <th class="text-center">Tuition Date</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tuitions as $index => $tuition)
                    <tr class="align-middle">
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>
                            {{ $tuition->studentTeacherHomeroomRelationship->student->identity_number }} -
                            {{ $tuition->studentTeacherHomeroomRelationship->student->name }}
                        </td>
                        <td>{{ DateFormat($tuition->tuition_date, 'DD MMMM Y') }}</td>
                        <td class="text-center">
                            @if ($tuition->status == 'Paid')
                                <span class="badge badge-success">Paid</span>
                            @else
                                <span class="badge badge-warning">Unpaid</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin')
                                    <a href="{{ route('tuition.edit', $tuition->id) }}" title="Edit" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('tuition.destroy', $tuition->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                            onclick="return confirm('Anda yakin mau menghapus tuition {{ $tuition->name }} ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @elseif(auth()->user()->role === 'Student' && $tuition->studentTeacherHomeroomRelationship->student->id === auth()->user()->id)
                                    @if ($tuition->status === 'Paid')
                                        <a href="{{ URL::to('invoice/' . $tuition->id) }}" title="Detail Payment" class="btn btn-sm btn-outline-warning me-2">
                                            <i class="fas fa-receipt"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('tuition.edit', $tuition->id) }}" title="Pay Off" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
