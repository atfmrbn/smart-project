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
            @elseif (auth()->user()->role == 'Teacher')
                <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @elseif (auth()->user()->role == 'Parent')
                <li class="breadcrumb-item"><a href="{{ route('parent.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/extracurricular') }}">Extracurricular Activities</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ $extracurricular->name }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control"
                    value="{{ $extracurricular->description }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="extracurricular-submit">
                <a href="{{ URL::to('extracurricular/') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
