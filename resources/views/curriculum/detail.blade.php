@extends('layouts.main')
@section('container')
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent; border: none;">
            @if (auth()->user()->role == 'Super Admin')
                <li class="breadcrumb-item"><a href="{{ route('superAdmin.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="{{ URL::to('/curriculum') }}">Curriculums</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="year">Year</label>
                <input type="text" id="year" name="year" class="form-control" value="{{ $curriculum->year }}"
                    readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control"
                    value="{{ $curriculum->description }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group local-forms">
                <label for="is_default">Is Default</label>
                <input type="text" id="is_default" name="is_default" class="form-control"
                    value="{{ $curriculum->is_default }}" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="curriculum-submit">
                <a href="{{ URL::to('curriculum/') }}" class="btn btn-sm btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
