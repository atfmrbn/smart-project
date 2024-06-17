<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        /* Add some basic styling for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center; /* Center-align the text */
        }

        h1 {
            text-align: center; /* Center-align the title */
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>Identity Number</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>NIK</th>
                <th>Address</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->identity_number }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->username }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($student->born_date)->format('d-m-Y') }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->nik }}</td>
                    <td>{{ $student->address }}</td>
                    <td>{{ $student->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
