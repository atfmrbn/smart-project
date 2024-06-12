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
            @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->identity_number }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->username }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($teacher->born_date)->format('d-m-Y') }}</td>
                    <td>{{ $teacher->phone }}</td>
                    <td>{{ $teacher->nik }}</td>
                    <td>{{ $teacher->address }}</td>
                    <td>{{ $teacher->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
