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
                <th>Student</th>
                <th>Teacher Homeroom</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentTeacherHomeroomRelationships as $studentTeacherHomeroomRelationship)
                <tr>
                    <td>{{ $studentTeacherHomeroomRelationship->id }}</td>
                    <td>{{ $studentTeacherHomeroomRelationship->student->identity_number }} - {{ $studentTeacherHomeroomRelationship->student->name }}</td>
                    <td>{{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->identity_number }} - {{ $studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
