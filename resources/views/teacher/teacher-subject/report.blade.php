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
                <th>Teacher</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher_subjects as $teacher_subject)
                    <tr>
                        <td class="text-center">{{ $teacher_subject->id }}</td>
                        <td class="text-center">{{ $teacher_subject->teacher->name }}</td>
                        <td class="text-center">{{ $teacher_subject->subject->name }} -
                        {{ $teacher_subject->subject->name }}</td>
            @endforeach
        </tbody>
    </table>
</body>
</html>
