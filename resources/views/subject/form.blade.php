@extends('layouts.main')
@section('container')

@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
@if(isset($subject))
<form method="POST" action="{{ URL::to('subject/' . $subject->id) }}">
    @method('put')
@else
<form method="POST" action="{{ URL::to('subject') }}">
@endif
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="classroom_type_id">Classroom Type <span class="login-danger">*</span></label>
                <select name="classroom_type_id" id="classroom_type_id" class="form-control">
                    <option value="" disabled selected>Pilih kelas</option>
                    @foreach ($classroom_types as $classroom_type) 
                        <option value="{{ $classroom_type->id }}" {{ isset($subject) ? ($subject->classroom_type_id === $classroom_type->id ? 'selected' : '') : "" }}>{{ $classroom_type->name }}</option>
                    @endforeach
                </select>
                @error('classroom_type')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>            
            <div class="form-group local-forms">
                <label for="name">Name <span class="login-danger">*</span></label>
                <input type="text" id="name" name="name" class="form-control  
                @error('name')is-invalid @enderror" value="{{ isset($subject)? 
                $subject->name : old('name')}}">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" id="description" name="description" class="form-control  
                @error('description')is-invalid @enderror" value="{{ isset($subject)? 
                $subject->description : old('description')}}">
                @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="{{ URL::to('subject/')  }}" class="btn  btn-secondary">Back</a>
        </div>
    </div>
</form>


@endsection