@extends("layouts.main")
@section('container')

<form>
    <div class="row">
        <div class="col-12">
            <h5 class="form-title"><span>{{ $title }}</span></h5>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Patron <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Description <span class="login-danger">*</span></label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Checkout Date <span class="login-danger">*</span></label>
                <input type="date" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label>Due Date <span class="login-danger">*</span></label>
                <input type="date" class="form-control">
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