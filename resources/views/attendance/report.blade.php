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
                <th>Student Teacher Homeroom</th>
                <th>Attendance Date</th>
                <th>Note</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->studentTeacherHomeroomRelationship->student->identity_number }} - {{ $attendance->studentTeacherHomeroomRelationship->student->name }} - {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->classroom->name }} -  {{ $attendance->studentTeacherHomeroomRelationship->teacherHomeroomRelationship->teacher->name }}</td>
                    <td>{{ DateFormat($attendance->attendance_date, 'DD MMMM Y') }}</td>
                    <td>{{ $attendance->note }}</td>
                    <td>{{ $attendance->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
