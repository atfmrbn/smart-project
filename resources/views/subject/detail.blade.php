@extends('layouts.main')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
            </div>
        </div>
        <div class="form-group">
            <label for="classroom_type_name">Classroom Type</label>
            <input type="text" id="classroom_type_name" name="classroom_type_name" class="form-control" value="{{ $subject->classroomType->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="year">Name</label>
            <input type="text" id="year" name="year" class="form-control" value="{{ $subject->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" class="form-control" value="{{ $subject->description }}" readonly>
        </div>
        <a href="{{ URL::to('subject/')  }}" class="btn btn-sm btn-secondary">Back</a>
        </div>
    </div>
</div>

@endsection