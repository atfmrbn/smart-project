<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>    
</head>
<body>
    <table id="example" class="table table-responsive table-striped table-bordered">
        <thead>
            <tr>
                <th style="width: 5%; text-align: center">No</th>
                <th style="text-align: center">Book</th>
                <th style="text-align: center">Category</th>
                <th style="text-align: center">Returned</th>
                <th style="text-align: center">Penalty</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrow->borrowDetail as $index => $borrowDetail)
            <tr>
                <td class="align-middle" style="text-align: center">{{ $index + 1 }}</td>
                <td class="align-middle">{{ $borrowDetail->book->title }}</td>
                <td class="align-middle">{{ $borrowDetail->book->category->name }}</td>
                <td class="align-middle" style="text-align: center;">
                    @if($borrowDetail->returned_date)
                        <span class="badge bg-success">Returned</span>
                    @else
                        <span class="badge bg-warning">Not Returned</span>
                    @endif
                </td>
                <td class="align-middle" style="text-align: center;">
                    {{ $borrowDetail->penalty ? 'Rp. ' . number_format($borrowDetail->penalty, 0, ',', '.') : 'No Penalty' }}
                </td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>