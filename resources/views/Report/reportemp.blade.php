<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Activity | Activities</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

        body {
            font-family: 'Kanit', sans-serif;
            background-color: #f6f6f6; /* Slightly grayish background for contrast */
        }

        .container {
            background-color: #ffffff; /* White background for the main content */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Shadow for depth */
            padding: 20px; /* Some padding for spacing */
            margin-top: 40px; /* Some margin for spacing from the top */
        }

        h1 {
            font-weight: bold;
            margin-bottom: 30px; /* Spacing after the title */
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
        /* Pagination styles */
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

        .container {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Adjust the shadow values as needed */
        }


    </style>

</head>
<body>
    @extends('layouts.master')
    @section('content')
    <div class="container">
        <!-- Title for Leave Applications -->
        <div class="report-title">
            <h1>รายชื่อพนักงานทั้งหมด</h1>
        </div>


        <a href="{{ route('generate-pdf3') }}" class="btn btn-primary">Generate PDF</a>
        <!-- Table for Leave Applications -->
        <table class="table table-bordered mb-4">
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>วันที่เข้าทำงาน</th>
                    <th>วันเกิด</th>
                    <th>ที่อยู่</th>
                    <th>เบอร์โทร</th>
                    <th>แผนก</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emp as $employee)
                <tr>
                    <td>{{ $employee->emp_id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->joining_date }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->contact_number }}</td>
                    <td>{{ $employee->department }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mb-4">
            {{ $emp->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <!-- Optional Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    @endsection
</body>

</html>
