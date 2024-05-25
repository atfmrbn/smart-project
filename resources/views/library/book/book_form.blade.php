@extends("layouts.main")
@section('container')

<form method="POST" action="{{ URL::to('book') }}" autocomplete="off" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>

        {{-- <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Book ID <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div> --}}

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Book Name <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Category <span class="login-danger">*</span></label>
                <select class="form-control select">
                    <option>Select Category</option>
                    {{-- <option>English</option>
                    <option>Turkish</option>
                    <option>Chinese</option>
                    <option>Spanish</option>
                    <option>Arabic</option> --}}
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Author <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Publisher <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Description <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>ISBN <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Status</label>
                <select class="form-control select">
                    <option>Available<span class="login-danger">*</span></option>
                    <option>Unavailable</option>
                </select>
            </div>
        </div>
        {{-- <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Type <span class="login-danger">*</span></label>
                <select class="form-control select">
                    <option>Select Type</option>
                    <option>Book</option>
                    <option>DVD</option>
                    <option>CD</option>
                    <option>Newspaper</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="form-group local-forms">
                <label>Status <span class="login-danger">*</span></label>
                <select class="form-control select">
                    <option>Select Status</option>
                    <option>In Stock</option>
                    <option>Out of Stock</option>
                </select>
            </div>
        </div> --}}
        <div class="col-12">
            <div class="student-submit">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection