@extends('layouts.main')
@section('container')

    @if (session()->has('successMessage'))
        <div class="alert alert-success">
            {{ session('successMessage') }}
        </div>
    @endif

    @if (session()->has('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
    @endif

    <div class="row align-items-center">
        @if (isset($tuition) && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin'))
            <div class="col-12">
                <h5>{{ isset($tuition) ? 'Edit' : 'Add' }} Tuition</h5>
            </div>
            
            <div class="col-auto text-end float-end ms-auto download-grp">
                {{-- <a href="{{ URL::to('tuition-detail-download/' . $tuition->id) }}" class="btn btn-primary mb-3"><i class="fas fa-download"></i> Download</a> --}}
            </div>
        @endif
    </div>
    <br>
    @if (isset($tuition) && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin'))
        <form method="POST" action="{{ route('tuition.update', $tuition->id) }}" autocomplete="off"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
        @elseif(!isset($tuition) && (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin'))
            <form action="{{ route('tuition.store') }}" method="POST" autocomplete="off">
    @endif
    @csrf
    @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin')
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="form-group local-forms">
                    <label for="student_teacher_homeroom_relationship_id">Student <span
                            class="login-danger">*</span></label>
                    <select name="student_teacher_homeroom_relationship_id" id="student_teacher_homeroom_relationship_id"
                        class="form-control data-select-2" {{ isset($tuition) ? 'disabled' : '' }}>
                        <option value="">Select Student</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->student_teacher_homeroom_relationship_id }}"
                                {{ isset($tuition) && $tuition->student_teacher_homeroom_relationship_id == $student->student_teacher_homeroom_relationship_id ? 'selected' : '' }}>
                                {{ $student->classroom_name }} - {{ $student->identity_number }} - {{ $student->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-sm-6">
                <div class="form-group local-forms">
                    <label for="tuition_date">Tuition Date <span class="login-danger">*</span></label>
                    <input type="date" id="tuition_date" name="tuition_date" class="form-control"
                        value="{{ isset($tuition) ? DateFormat($tuition->tuition_date, 'Y-MM-DD') : old('tuition_date') }}"
                        {{ isset($tuition) ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="col-12">
                <div class="student-submit">
                    @if (!isset($tuition))
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endif
                    <a href="{{ URL::to('tuition') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    @endif
    </form>

    @if (isset($tuition))
        <hr class="mt-4">
        <div class="row align-items-center mt-5">
            <div class="col">
                <h5>Tuition Details</h5>
            </div>
        </div>

        <div class="row">
            @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin')
                @if ($tuition->status !== 'Paid')
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
                                <input type="text" id="value" name="value"
                                    class="form-control @error('value') is-invalid @enderror"
                                    value="{{ isset($tuition) ? $tuition->value : old('value') }}">
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
                                <input type="text" id="description" name="description" class="form-control"
                                    value="{{ isset($tuition) ? $tuition->description : old('description') }}"
                                    {{ isset($tuitionDetail) ? 'disabled' : '' }} placeholder="Add description">
                            </div>
                        </div>
                        @if ($tuition->status !== 'Paid')
                            <button type="submit" class="btn btn-primary btn-block">Add Tuition</button>
                        @else
                            <button type="submit" class="btn btn-success btn-block" disabled>Paid</button>
                        @endif
                    </form>
                @endif
            @endif

            <div class="col-md-12 mt-2 table-responsive">
                <table id="" class="table table-responsive table-striped table-bordered mt-4">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center">No</th>
                            <th style="text-align: center">Tuition Type</th>
                            <th style="text-align: center">Description</th>
                            <th style="text-align: center">Bill (Rp.)</th>
                            @if ($tuition->status !== 'Paid') {{-- Cek apakah status bukan 'Paid' --}}
                                <th style="width: 10%; text-align: center">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($tuition->tuitionDetails as $index => $tuitionDetail)
                            <tr>
                                <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                                <td class="align-middle">{{ $tuitionDetail->tuitionType->name }}</td>
                                <td class="align-middle">{{ $tuitionDetail->description }}</td>
                                <td class="align-middle text-end">
                                    {{ NumberFormat($tuitionDetail->value) }}
                                    @php $total += $tuitionDetail->value; @endphp
                                </td>
                                @if ($tuition->status !== 'Paid') {{-- Cek apakah status bukan 'Paid' --}}
                                    <td class="align-middle">
                                        @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Super Admin')
                                            <div class="text-center d-flex justify-content-center">
                                                <form method="POST" action="{{ route('tuition-detail.destroy', $tuitionDetail->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger ms-2" title="Delete"
                                                        onclick="return confirm('Anda yakin mau menghapus tagihan {{ $tuitionDetail->tuitionType->name }}?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-center"><strong>Total</strong></td>
                            <td class="text-end"><strong>{{ NumberFormat($total) }}</strong></td>
                            @if ($tuition->status !== 'Paid') {{-- Cek apakah status bukan 'Paid' --}}
                                <td colspan="2"></td>
                            @endif
                        </tr>
                    </tbody>
                </table>


                <!-- Pay Off Form -->
                <form method="POST" action="{{ route('tuition.payoff', $tuition->id) }}">
                    @csrf
                    @foreach ($tuition->tuitionDetails as $index => $tuitionDetail)
                        <input type="hidden" name="tuitionDetails[{{ $index }}][name]"
                            value="{{ $tuitionDetail->tuitionType->name }}">
                        <input type="hidden" name="tuitionDetails[{{ $index }}][value]"
                            value="{{ $tuitionDetail->value }}">
                    @endforeach
                    <input type="hidden" name="total" value="{{ $total }}">
                    @if(auth()->user()->role === 'Student' && $status !== 'Paid')
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-dollar-sign"></i> Pay Off
                            </button>
                        </div>
                    {{-- @endif
                        <div class="text-end mt-3">
                            <button type="button" class="btn btn-sm btn-success" disabled>
                                <i class="fas fa-check"></i> Paid
                            </button>
                        </div> --}}
                    @endif
                </form>
            </div>
        </div>
    @endif
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
@endsection
