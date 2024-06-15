@extends("layouts.main")
@section('title', $title)
@section('container')


<h5>{{ isset($category) ? 'Edit' : 'Add' }} Category</h5>
<br>
@if(isset($category))
<form method="POST" action="{{ route('book-category.update', $category->id) }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@else
<form method="POST" action="{{ route('book-category.store') }}" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label for="name">Name <span class="login-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" 
                value="{{ isset($category) ? $category->name : old('name') }}" required>
            </div>
        </div>
        <div class="col-12 col-sm-12">
            <div class="form-group">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" name="description" id="description" class="form-control" 
                value="{{ isset($category) ? $category->description : old('description') }}" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ URL::to('book-category') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</form>

@endsection
