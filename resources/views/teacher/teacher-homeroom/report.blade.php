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
                <th>Teacher</th>
                <th>Classroom</th>
                <th>Curriculum</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher_homerooms as $teacher_homeroom)
                <tr>
                    <td class="text-center">{{ $teacher_homeroom->id }}</td>
                    <td class="text-center">{{ $teacher_homeroom->teacher->name }}</td>
                    <td class="text-center">{{ $teacher_homeroom->classroom->classroomType->name }} - {{ $teacher_homeroom->classroom->name }}</td>
                    <td class="text-center">{{ $teacher_homeroom->curriculum->year }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
