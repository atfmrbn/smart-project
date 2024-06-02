@extends('layouts.main')
@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Extracurricular Detail</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $extracurricular->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" id="description" name="description" class="form-control" value="{{ $extracurricular->description }}" readonly>
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::to('extracurricular/') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
