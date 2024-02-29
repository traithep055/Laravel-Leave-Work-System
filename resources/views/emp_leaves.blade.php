<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>
<style>
    body {
      background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url('https://cdn.pic.in.th/file/picinth/bg-masthead.jpeg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Kanit', sans-serif;
    }
</style>
<body>
    @extends('layouts.master')

    @section('content')
        <div class="container mt-5">
            <h1>Your Leave Applications</h1><br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Cause</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($leaveApplications as $leaveApplication)
                        <tr>
                            <td>{{ $leaveApplication->leave_applications_id }}</td>
                            <td>{{ $leaveApplication->from_date }}</td>
                            <td>{{ $leaveApplication->to_date }}</td>
                            <td>{{ $leaveApplication->reason }}</td>
                            <td style="{{ $leaveApplication->status == 'อนุมัติ' ? 'color: green;' : ($leaveApplication->status == 'ปฏิเสธ' ? 'color: red;' : '') }}">
                                {{ $leaveApplication->status }}
                            </td>
                            <td>{{ $leaveApplication->cause }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No leave applications found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</body>

</html>
