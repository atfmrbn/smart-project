<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .report-header, .report-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title {
            text-align: center;
            margin-bottom: 40px;
        }
        .student-info {
            margin-bottom: 40px;
        }
        .student-info p {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .signature-section {
            text-align: right;
            margin-top: 60px;
            /* margin-right: 20%; */
        }
        .signature-line {
            margin-top: 60px;
            margin-bottom: 20px;
            /* margin-right: 10%; Adjust this value to move the line more to the right */
        }
    </style>
</head>
<body>

    <div class="report-header">
        <h4>{{$configuration->name}}</h4>
        <p>Email: {{$configuration->email}} Phone: {{$configuration->phone}} Address: {{$configuration->address}}</p>
    </div>

    <hr>
    <br>

    <h5 class="text-center">{{ $title }}</h5>

    <br>

    <div class="student-info">
        <p><strong>Student Name:</strong> {{ $student->name }}</p>
        <p><strong>Student Number:</strong> {{ $student->identity_number }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Subject</th>                
                <th>Average</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gradeDetails as $index => $gradeDetail)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $gradeDetail->subject_name }}</td>
                    <td>{{ $gradeDetail->total_grade_value }}</td>
                    <td>{{ $gradeDetail->average_grade_value }}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-center">
        <div class="signature-section">
            <p><strong>{{ DateFormat($date, 'DD MMMM Y') }}</strong></p>
            <p><strong>Teacher Homeroom</strong></p>
            <div class="signature-line">____________________</div>
        </div>
    </div>
    
</body>
</html>
