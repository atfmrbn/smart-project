@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $taskType->name }}" readonly>
        </div>
        <a href="{{ URL::to('task-type/')  }}" class="btn btn-sm btn-secondary">Back</a>
    </div>
</div>

@endsection