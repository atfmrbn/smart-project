@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Detail Ruang Kelas
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" value="{{ $classroom->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="classroomType_name">Classroom Type Name</label>
                        <input type="text" id="classroomType_name" class="form-control" value="{{ $classroom->classroomType->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::to('classroom') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
