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
                <th>Id</th>
                <th>Classroom</th>
                <th>Teacher Subject</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher_classrooms as $teacher_classroom)
                <tr>
                    <td class="text-center">{{ $teacher_classroom->id }}</td>
                    <td class="text-center">
                        {{ $teacher_classroom->teacherHomeroomRelationship->classroom->classroomType->name }} -
                        {{ $teacher_classroom->teacherHomeroomRelationship->classroom->name }}
                    </td>
                    <td class="text-center">
                        {{ $teacher_classroom->TeacherSubjectRelationship->teacher->name }}-{{ $teacher_classroom->teacherSubjectRelationship->subject->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
