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
                <th>#</th>
                <th>Identity Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parents as $parent)
                    <tr>
                        <td>{{ $parent->id }}</td>
                        <td>{{ $parent->identity_number }}</td>
                        <td>{{ $parent->name }}</td>
                        <td>{{ $parent->email }}</td>
                        <td>{{ $parent->gender }}</td>
                        <td>{{ $parent->born_date }}</td>
                        <td>{{ $parent->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
