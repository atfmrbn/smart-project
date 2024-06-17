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
                <th>Grade</th>
                <th>Student</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gradeDetails as $gradeDetail)
                <tr>
                    <td class="text-center">{{ $gradeDetail->id }}</td>
                    <td class="text-center">
                        {{ optional($gradeDetail->grade->taskType)->name ?? '' }} -
                        {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom)->classroomType->name ?? '' }}                            -
                        {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherHomeroomRelationship->classroom)->name ?? '' }}        -
                        {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherSubjectRelationship->teacher)->name ?? '' }}-
                        {{ optional($gradeDetail->grade->teacherClassroomRelationship->teacherSubjectRelationship->subject)->name ?? '' }}
                    </td>
                    <td class="text-center">{{ optional($gradeDetail->student)->name }}</td>
                    <td class="text-center">{{ $gradeDetail->value }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
