<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: red;
        }

        .container {
            background-color: #aea1a1;
            border-radius: 5px;
            padding: 20px;
        }

        .chart-container {
            width: 30%;
            /* margin: 0 auto; */
            margin-top: 50px;
        }

        #myChart {
            display: block;
            max-width: 100%;
            height: auto;
        }

        .card {
            /* Remove explicit width and height */
        }
    </style>
</head>

<body>
    {{-- @extends('layouts.master') --}}
    @extends('layouts.inc.admin_dashboard')
    @section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>ข้อมูลผู้ดูแล</h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User ID</th> <!-- Add this line for User ID heading -->
                                    <th>Role</th>
                                    <th>Email</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <tr>
                                    <td>{{ $data->user_id ?? 'N/A' }}</td>
                                    <td>{{ $data->role ?? 'N/A' }}</td>
                                    <td>{{ $data->email ?? 'N/A' }}</td>
                                    {{-- <td><a href="{{ url('logout') }}">Logout</a></td> --}}
                                </tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="container mt-4">
            <!-- Row for Header -->
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">จัดการข้อมูลผู้ใช้</h2>
                </div>
            </div>
            <div class="d-flex">
                <div class="columns">
                    <!-- User Card -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body  bg-warning">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fas fa-user fa-3x me-3"></i>
                                    <div>
                                        <h5 class="card-title mb-1">Users</h5>
                                        <p class="card-text">Manage all registered users.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('user.index') }}" class="btn btn-outline-dark">Go to Users</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Employee Card -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body bg-warning">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fas fa-users fa-3x me-3 "></i>
                                    <div>
                                        <h5 class="card-title mb-1">Employees</h5>
                                        <p class="card-text">Manage all registered employees.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end ">
                                <a href="{{ route('employee.index') }}" class="btn btn-outline-dark">Go to Employees</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Job Details Card -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body bg-warning">
                                <div class="d-flex justify-content-start align-items-center">
                                    <i class="fas fa-briefcase fa-3x me-3"></i>
                                    <div>
                                        <h5 class="card-title mb-1">Job Details</h5>
                                        <p class="card-text">Manage all Job Details of employees.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('jobdetails-edit.index') }}" class="btn btn-outline-dark">Job Details</a>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="chart-container col-12 mt-4">
                    <canvas id="myChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div> <!-- End Container -->


        <div class="container mt-2">
            <div class="row">
                <h2>ข้อมูลการลา</h2>

                <!-- Card 1 -->
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-user-check fa-3x"></i> <!-- ใช้ Font Awesome Icon -->
                            <h3 class="mt-3">{{ $AllCount }}</h3>
                            <p class="card-text">คำขออนุมัติ</p>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-check fa-3x"></i>
                            <h3 class="mt-3">{{ $approvedCount }} ครั้ง</h3>
                            <p class="card-text"> อนุมัติแล้ว</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-times fa-3x"></i>
                            <h3 class="mt-3">{{ $refuseCount }} ครั้ง</h3>
                            <p class="card-text">ไม่อนุมัติ</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-md-3">
                    <div class="card bg-secondary text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-user fa-3x"></i>
                            <h3 class="mt-3">{{ $employeeCount }} คน</h3>
                            <p class="card-text">พนักงาน</p>
                        </div>
                    </div>
                </div>

            </div>
        </div><br>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: @json($departments->pluck('department')),
                    datasets: [{
                        label: 'Number of Employees',
                        data: @json($departments->pluck('total')),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    legend: {
                        display: true,
                        position: 'right'
                    }
                }
            });
        </script>
    </div>
    @endsection
</body>

</html>
