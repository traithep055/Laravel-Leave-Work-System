
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* Dark header background */
        .card-header.bg-success {
            background-color: #333 !important; /* Dark gray background */
            color: #FFF !important; /* White text */
        }

        /* Dark table header background with light text */
        .table thead th {
            background-color: #333; /* Dark gray background */
            color: #FFF; /* White text */
            border-color: #444; /* Slightly darker border for distinction */
        }

        /* Dark border for the table cells */
        .table td, .table th {
            border-color: #444;
        }

        /* Light background for table rows when hovered */
        .table tbody tr:hover {
            background-color: #f5f5f5;
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

        /* Add shadow to the card */
        .card {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Adjust the shadow values as needed */
        }
    </style>
</head>
<body>
    {{-- @extends('layouts.master') --}}
    @extends('layouts.inc.admin_dashboard')
    @section('content')
    @if(session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2><i class="fas fa-list"></i> Attendance List</h2>
                    </div>
                    <a href="/run-command" class="btn btn-success">เช็คคนเข้างาน</a>
                    <div class="card-body">
                        <h3>เข้างาน</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Employee ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendancePresent as $item)
                                <tr>
                                    <td>{{ $item->first_name }}  {{ $item->last_name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->emp_id }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $attendancePresent->links('pagination::bootstrap-5') }}
                        </div>

                        <h3>ลางาน</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Employee ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendanceOnLeave as $item)
                                <tr>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->emp_id }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mb-4">
                            {{ $attendanceOnLeave->links('pagination::bootstrap-4') }}



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
