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
                <th>ID</th>
                <th>Identity Number</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>NIK</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($librarians as $index => $librarian)
            <tr>
                <td>{{ $librarian->id }}</td>
                <td>{{ $librarian->identity_number }}</td>
                <td>{{ $librarian->name }}</td>
                <td>{{ $librarian->username }}</td>
                <td>{{ $librarian->email }}</td>
                <td>{{ $librarian->gender }}</td>
                <td>{{ $librarian->born_date }}</td>
                <td>{{ $librarian->phone }}</td>
                <td>{{ $librarian->nik }}</td>
                <td>{{ $librarian->address }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
