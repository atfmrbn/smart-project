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
                <th>No</th>
                <th>Classroom</th>
                <th>Teacher</th>
                <th>Schedule</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacherSchedules as $teacherSchedule)
                <tr>
                    <td class="text-center">{{ $teacherSchedule->id }}</td>
                    <td>{{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->classroomType->name }}
                        -
                        {{ $teacherSchedule->teacherClassroomRelationship->teacherHomeroomRelationship->classroom->name }}
                    </td>
                    <td>{{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->teacher->name }} -
                        {{ $teacherSchedule->teacherClassroomRelationship->teacherSubjectRelationship->subject->name }}
                    </td>
                    <td>{{ $teacherSchedule->schedule_day }}
                        {{ \Carbon\Carbon::parse($teacherSchedule->schedule_time_start)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($teacherSchedule->schedule_time_end)->format('H:i') }}
                    </td>
            @endforeach
        </tbody>
    </table>
</body>
</html>
