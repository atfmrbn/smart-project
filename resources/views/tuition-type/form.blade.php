@extends('layouts.main')
@section('container')

@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@if(isset($tuitionType))
<form method="POST" action="{{ URL::to('tuition-type/' . $tuitionType->id) }}">
    @method('put')
@else
<form method="POST" action="{{ URL::to('tuition-type') }}">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="name">Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control @error('name')is-invalid @enderror" value="{{ isset($tuitionType) ? $tuitionType->name : old('name')}}" autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{ URL::to('tuition-type/')  }}" class="btn  btn-secondary">Back</a>
        </div>
    </div>
</form>


@endsection
