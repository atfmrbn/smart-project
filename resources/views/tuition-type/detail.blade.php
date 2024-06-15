@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TuitionType Detail</h3>
            </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $tuitionType->name }}" readonly>
        </div>
        <a href="{{ URL::to('tuition-type/')  }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
</div>

@endsection
