@extends('layouts.main')
@section('container')

@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
@if(isset($curriculum))
<form method="POST" action="{{ URL::to('curriculum/' . $curriculum->id) }}">
    @method('put')
@else
<form method="POST" action="{{ URL::to('curriculum') }}">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="year">Year <span class="login-danger">*</span></label>
                <input type="text" id="year" name="year" class="form-control  
                @error('year')is-invalid @enderror" value="{{ isset($curriculum)? 
                $curriculum->year : old('year')}}">
                @error('year')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" id="description" name="description" class="form-control  
                @error('description')is-invalid @enderror" value="{{ isset($curriculum)? 
                $curriculum->description : old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            {{-- <div class="form-group local-forms">
                <label for="is_default">Is Default <span class="login-danger">*</span></label>
                <input type="text" id="is_default" name="is_default" class="form-control  
                @error('is_default')is-invalid @enderror" value="{{ isset($curriculum)? 
                $curriculum->is_default : old('is_default')}}">
                @error('is_default')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div> --}}
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{ URL::to('curriculum/')  }}" class="btn  btn-secondary">Back</a>
        </div>
    </div>
</form>


@endsection