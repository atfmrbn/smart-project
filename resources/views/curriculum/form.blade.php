@extends('layouts.main')
@section('container')

@if(isset($curriculum))
<form method="POST" action="{{ URL::to('curriculum/' . $curriculum->id) }}">
    @method('put')
@else
<form method="POST" action="{{ URL::to('curriculum') }}">
@endif
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="year">Year</label>
                <input type="text" id="year" name="year" class="form-control  
                @error('year')is-invalid @enderror" value="{{ isset($curriculum)? 
                $curriculum->year : old('year')}}">
                @error('year')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control  
                @error('description')is-invalid @enderror" value="{{ isset($curriculum)? 
                $curriculum->description : old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{ URL::to('curriculum/')  }}" class="btn  btn-secondary">Back</a>
        </div>
    </div>
</form>


@endsection