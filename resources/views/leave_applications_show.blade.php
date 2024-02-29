<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .detail-table dt,
        .detail-table dd {
            padding: 8px 12px;
        }

        .detail-table dt {
            text-align: right;
            background-color: #f5f5f5;
        }

        .modal-header {
            background-color: #336cbd;
            color: white;
        }

        .modal-title i {
            margin-right: 10px;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - (1.75rem * 2));
        }
    </style>

</head>

<body>
    @extends('layouts.master')

    @section('content')
        <div class="container mt-5">
            <h1>คำขออนุมัติการลา</h1><br>

            <!-- Table for Applications with No Status -->
            <h2>คำขอ</h2>
            @include('partials.leave_application_table', ['applications' => $leaveApplications->filter(function ($application) {
                return empty($application->status);
            })])
            <br>
            <!-- Table for Approved Applications -->
            <h2>คำขอที่อนุมัติ</h2>
            @include('partials.leave_application_table', ['applications' => $leaveApplications->filter(function ($application) {
                return $application->status == "อนุมัติ";
            })])
            <br>
            <!-- Table for Declined Applications -->
            <h2>คำขอที่ปฏิเสธ</h2>
            @include('partials.leave_application_table', ['applications' => $leaveApplications->filter(function ($application) {
                return $application->status == "ปฏิเสธ";
            })])
        </div>
    @endsection


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

    
</body>

</html>
