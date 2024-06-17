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
                <th>Task Type</th>
                <th>Teacher Homeroom</th>
                <th>Percentage (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $grade->taskType->name }}</td>
                    <td>{{ $grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }} -
                        {{ $grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }} - {{ $grade->teacherClassroomRelationship->TeacherSubjectRelationship->teacher->name }}-{{ $grade->teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}</td>
                    <td>{{ $grade->percentage }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
