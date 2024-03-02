<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Activity | Activities</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');

    *{font-family: 'Kanit', sans-serif;}
    form #btnSave{
        transition: 0.5s ease;
    }
    form #btnSave:hover{background-color: rgb(26, 197, 197); color: #fff;}
    .card-body{font-size: 1rem;}
    h4{
        text-align: center;
    }
    h1{
        text-align: center;
    }
    .table{
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
        .table {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Adjust the shadow values as needed */
        }
  </style>

</head>

<body>
        @extends('layouts.inc.admin_dashboard')
        {{-- @extends('layouts.master') --}}
    
    @section('content')
    <div class="container">
        <div class="report-title">
            <br><br>
            <h1>รายงานการขอลา</h1><br>
        </div>
        <a href="{{ route('generate-pdf2') }}" class="btn btn-primary">Generate PDF</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>วันที่เริ่มต้น</th>
                    <th>วันที่สิ้นสุด</th>
                    <th>เหตุผล</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leavework as $leave)
                <tr>
                    <td>{{ $leave->emp_id }}</td>
                    <td>{{ $leave->first_name }}</td>
                    <td>{{ $leave->last_name }}</td>
                    <td>{{ $leave->from_date }}</td>
                    <td>{{ $leave->to_date }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td style="{{ $leave->status == 'อนุมัติ' ? 'color: green;' : ($leave->status == 'ปฏิเสธ' ? 'color: red;' : '') }}">
                        {{ $leave->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4">
            {{ $leavework->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @endsection



    <!-- Add Bootstrap 5's CSS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>

