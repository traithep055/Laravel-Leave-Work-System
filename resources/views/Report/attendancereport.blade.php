<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Activity | Activities</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        * {
            font-family: 'Kanit', sans-serif;
        }

        form #btnSave {
            transition: 0.5s ease;
        }

        form #btnSave:hover {
            background-color: rgb(26, 197, 197);
            color: #fff;
        }

        .card-body {
            font-size: 1rem;
        }

        h4 {
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        .table {
            text-align: center;
        }
        .table {
            text-align: center;
        }
        .report-title {
            margin-bottom: 20px; /* Spacing for the report title */
        }
        .table thead th {
        background-color: #2c2c2c;
        color: #ffffffdc;
        }
        .pagination {
    justify-content: center; /* Center the pagination */
    margin-top: 20px; /* Add some spacing above the pagination */
}

.pagination .page-item .page-link {
    border: none;
    background-color: transparent;
    color: #2c2c2c; /* Dark color like the table header */
    padding: 5px 10px; /* Some padding for the pagination numbers */
}

.pagination .page-item.active .page-link {
    background-color: #2c2c2c; /* Dark background for the active page */
    color: #ffffff; /* White text for the active page */
}

.pagination .page-item:not(.active) .page-link:hover {
    background-color: #e0e0e0; /* Slightly darker background on hover */
}

/* Remove the borders */
.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
    border-radius: 0;
}
.pagination .hidden {
    display: none;
}
.table {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Adjust the shadow values as needed */
        }
    </style>

</head>

<body>
    @extends('layouts.master')
    @section('content')
    <div class="container">

        <div class="report-title">
            <br><br>
            <h1>รายงานการเข้าประจำวัน</h1><br>
        </div>

        @php
        // Grouping the attendance details by date
        $grouped = $attendanceDetails->groupBy('date');
        @endphp

        @foreach($grouped as $date => $details)
        <h4 class="mt-5">วันที่: {{ $date }}</h4>
        <a href="{{ route('generate-pdf') }}" class="btn btn-primary">Generate PDF</a>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>แผนก</th>
                    <th>สถานะการเข้างาน</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->emp_id }}</td>
                    <td>{{ $detail->first_name }}</td>
                    <td>{{ $detail->last_name }}</td>
                    <td>{{ $detail->department }}</td>
                    <td style="{{ $detail->status == 'Present' ? 'color: green;' : ($detail->status == 'On-Leave' ? 'color: red;' : '') }}">
                        {{ $detail->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @endforeach
        <div class="d-flex justify-content-center mt-4">
            {{ $dates->links('pagination::bootstrap-4') }}
        </div>
    </div>


    <!-- Add Bootstrap 5's JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    @endsection


</body>

</html>
