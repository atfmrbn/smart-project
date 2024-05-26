@extends("layouts.main")
@section('container')


<h5>{{ isset($book) ? 'Edit' : 'Add' }} Book</h5>
<br>
@if(isset($book))
<form method="POST" action="{{ route('book.update', $book->id) }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    @method("PUT")
@else
<form method="POST" action="{{ route('book.store') }}" autocomplete="off" enctype="multipart/form-data">
@endif
    @csrf
    <div class="row">
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="title">Book Name <span class="login-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control" 
                value="{{ isset($book) ? $book->title : old('name') }}" >
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="category_id">Category <span class="login-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-control select">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category) 
                        <option value="{{ $category->id }}" {{ (isset($book) && $book->category_id == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="author">Author <span class="login-danger">*</span></label>
                <input type="text" name="author" id="author" class="form-control" 
                value="{{ isset($book) ? $book->author : old('name') }}" >
            </div>
        </div>
        
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="publisher">Publisher <span class="login-danger">*</span></label>
                <input type="text" name="publisher" id="publisher" class="form-control" 
                value="{{ isset($book) ? $book->publisher : old('name') }}" >
            </div>
        </div>
        
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="published_year">Published Year <span class="login-danger">*</span></label>
                <input type="text" name="published_year" id="published_year" class="form-control" 
                value="{{ isset($book) ? $book->published_year : old('name') }}" >
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label for="isbn">ISBN <span class="login-danger">*</span></label>
                <input type="text" name="isbn" id="isbn" class="form-control" 
                value="{{ isset($book) ? $book->isbn : old('name') }}" >
            </div>
        </div>

        <div class="col-12 col-sm-4">
        <div class="form-group local-forms">
            <label for="status">Status <span class="login-danger">*</span></label>
            <select name="status" id="status" class="form-control select" required>
                <option value="">Select Status</option>
                <option value="available" {{ (isset($book) && $book->status == 'available') ? 'selected' : '' }}>Available</option>
                <option value="unavailable" {{ (isset($book) && $book->status == 'unavailable') ? 'selected' : '' }}>Unavailable</option>
            </select>
        </div>
    </div>

        <div class="col-12 col-sm-8">
            <div class="form-group local-forms">
                <label for="description">Description <span class="login-danger">*</span></label>
                <input type="text" name="description" id="description" class="form-control" 
                value="{{ isset($book) ? $book->description : old('description') }}">
            </div>
        </div>
        
        <div class="col-12 col-sm-12">
            <div class="form-group local-forms">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" 
                value="{{ isset($book) ? $book->image : old('image') }}">
            </div>
        </div>

        <div class="col-12">
            <div class="student-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>
@endsection