<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }
        .bg-success {
            background-color: #28a745;
            color: #fff;
        }
        .bg-warning {
            background-color: #ffc107;
            color: #212529;
        }
    </style>
</head>
<body>
   <div class="row">
    {{-- <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="student_id">Patron <span class="login-danger">*</span></label>
            <select name="student_id" id="student_id" class="form-control data-select-2" {{ isset($borrow) ? 'disabled' : '' }}>
                <option value="">Select Patron</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ (isset($borrow) && $borrow->student_id == $student->id) ? 'selected' : '' }}>
                        {{ $student->classroom_name }} - {{ $student->identity_number }}  - {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div> --}}

    {{-- <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="description">Description <span class="login-danger">*</span></label>
            <input type="text" id="description" name="description" class="form-control" value="{{ isset($borrow) ? $borrow->description : old('description') }}" {{ isset($borrow) ? 'disabled' : '' }} placeholder="Add description">
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="checkout_date">Checkout Date <span class="login-danger">*</span></label>
            <input type="date" id="checkout_date" name="checkout_date" class="form-control" value="{{ isset($borrow) ? $borrow->checkout_date : old('checkout_date') }}" {{ isset($borrow) ? 'disabled' : '' }}>
        </div>
    </div>

    <div class="col-12 col-sm-6">
        <div class="form-group local-forms">
            <label for="due_date">Due Date <span class="login-danger">*</span></label>
            <input type="date" id="due_date" name="due_date" class="form-control" value="{{ isset($borrow) ? $borrow->due_date : old('due_date') }}" {{ isset($borrow) ? 'disabled' : '' }}>
        </div>
    </div> --}}

</div>



    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Book</th>
                <th>Category</th>
                <th>Returned</th>
                <th>Penalty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowDetails as $index => $borrowDetail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $borrowDetail->book->title ?? 'No Title' }}</td>
                    <td>{{ $borrowDetail->book->category->name ?? 'No Category' }}</td>
                    <td class="text-center">
                        @if($borrowDetail->returned_date)
                            <span class="badge bg-success">Returned</span>
                        @else
                            <span class="badge bg-warning">Not Returned</span>
                        @endif
                    </td>
                    <td>{{ $borrowDetail->penalty ? 'Rp. ' . number_format($borrowDetail->penalty, 0, ',', '.') : 'No Penalty' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
