@extends("layouts.main")
{{-- @section('title', $title) --}}
@section('container')

@if(session()->has("successMessage"))
    <div class="alert alert-success">
        {{ session("successMessage") }}
    </div>
@endif

@if(session()->has("errorMessage"))
    <div class="alert alert-danger">
        {{ session("errorMessage") }}
    </div>
@endif

<div class="row align-items-center">
    <div class="col">
        <h5>{{ isset($tuition) ? 'Edit' : 'Add' }} Tuition</h5>
    </div>
    @if(isset($tuition))
    <div class="col-auto text-end float-end ms-auto download-grp">
        {{-- <a href="{{ URL::to('tuition-detail-download/' . $tuition->id) }}" class="btn btn-primary mb-3"><i class="fas fa-download"></i> Download</a> --}}
    </div>
    @endif
</div>
<br>
@if(isset($tuition))
<form method="POST" action="{{ route('tuition.update', $tuition->id) }}" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf
@else
<form action="{{ route('tuition.store') }}" method="POST" autocomplete="off">
@endif
    @csrf
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="student_teacher_homeroom_relationship_id">Student <span class="login-danger">*</span></label>
                <select name="student_teacher_homeroom_relationship_id" id="student_teacher_homeroom_relationship_id" class="form-control data-select-2" {{ isset($tuition) ? 'disabled' : '' }}>
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ (isset($tuition) && $tuition->student_teacher_homeroom_relationship_id == $student->id) ? 'selected' : '' }}>
                            {{ $student->classroom_name }} - {{ $student->identity_number }}  - {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group local-forms">
                <label for="tuition_date">Tuition Date <span class="login-danger">*</span></label>
                <input type="date" id="tuition_date" name="tuition_date" class="form-control" value="{{ isset($tuition) ? $tuition->tuition_date : old('tuition_date') }}" {{ isset($tuition) ? 'disabled' : '' }}>
            </div>
        </div>

        <div class="col-12">
            <div class="student-submit">
                @if(!isset($tuition))
                <button type="submit" class="btn btn-primary">Submit</button>
                @endif
                <a href="{{ URL::to('tuition') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </div>
    </div>
</form>


@if(isset($tuition))
<hr class="mt-4">
<div class="row align-items-center mt-5">
    <div class="col">
        <h5>Tuition Details</h5>
    </div>
</div>

<div class="row">
            {{-- @if($canBorrow) --}}
            <form action="{{ route('tuition-detail.store') }}" method="POST" autocomplete="off" class="mt-4">
                @csrf
                <div class="col-12">
                    <div class="form-group local-forms">
                        <label for="value">Tuition Type <span class="login-danger">*</span></label>
                        <input type="hidden" name="tuition_id" value="{{ $tuition->id }}">
                        <select name="tuition_type_id" id="tuition_type_id" class="form-control data-select-2">
                            <option value="">Select Tuition Type</option>
                            @foreach ($tuitionTypes as $tuitionType)
                                <option value="{{ $tuitionType->id }}">
                                    {{ $tuitionType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group local-forms">
                        <label for="value">Bill <span class="login-danger">*</span></label>
                        <input type="text" id="value" name="value" class="form-control @error('value') is-invalid @enderror" value="{{ isset($tuition) ? $tuition->value : old('value') }}">
                        @error('value')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 col-sm-12">
                    <div class="form-group local-forms">
                        <label for="description">Description <span class="login-danger">*</span></label>
                        <input type="text" id="description" name="description" class="form-control" value="{{ isset($tuition) ? $tuition->description : old('description') }}" {{ isset($tuitionDetail) ? 'disabled' : '' }} placeholder="Add description">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
            {{-- @endif --}}

    <div class="col-md-12 mt-2 table-responsive">
        <table id="example" class="table table-responsive table-striped table-bordered mt-4">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center">No</th>
                <th style="text-align: center">Tuition Type</th>
                <th style="text-align: center">Bill (Rp.)</th>
                <th style="text-align: center">Description</th>
                <th style="width: 10%; text-align: center">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tuition->tuitionDetails as $index => $tuitionDetail)
            <tr>
                <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                <td class="align-middle">{{ $tuitionDetail->tuitionType->name }}</td>
                <td class="align-middle text-end">
                    {{ NumberFormat($tuitionDetail->value) }}
                </td>
                <td class="align-middle">{{ $tuitionDetail->description }}</td>
                <td class="align-middle">
                    <div class="text-center d-flex justify-content-center">
                        <form method="POST" action="{{ route('tuition-detail.destroy', $tuitionDetail->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger ms-2" title="Delete" onclick="return confirm('Anda yakin mau menghapus tagihan {{ $tuitionDetail->tuitionType->name }}?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</div>
@endif


@endsection