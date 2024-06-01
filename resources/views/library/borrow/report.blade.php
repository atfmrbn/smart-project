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
<h5 class="text-center">Laporan Peminjaman Buku Aktif</h5>
<br><br>
<div class="table-responsive">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="student-thread">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Patron</th>
                <th class="text-center">Description</th>
                <th class="text-center">Checkout Date</th>
                <th class="text-center">Due Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($borrows as $index => $borrow)
            <tr class="align-middle">
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $borrow->classroom_name }} - {{ $borrow->identity_number }}  - {{ $borrow->name }}</td>
                <td>{{ $borrow->description }}</td>
                <td>{{ $borrow->checkout_date }}</td>
                <td>{{ $borrow->due_date }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>