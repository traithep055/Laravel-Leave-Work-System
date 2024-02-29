<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มใบลา</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

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

   .modern-transparent-card {
        background-color: rgba(255, 255, 255, 0.767)!important;

        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);  /* Soft shadow for depth */
        border-radius: 15px;  /* Rounded corners */
        overflow: hidden;  /* Keeps inner content (like the header) within the card's rounded corners */
   }

   .modern-transparent-card .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);  /* Slight border to separate header from content */
        background-color: rgba(0, 0, 0, 0.1);  /* Slightly dark header for contrast */
   }

   .modern-transparent-card h4 {
        font-weight: 600;  /* Boldness for the title */
   }

   .modern-transparent-card .btn {
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);  /* Shadow for the button */
   }

   .modern-transparent-card .btn:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);  /* Slight upward motion on hover for a dynamic effect */
   }

   /* Icon color and spacing adjustments */
   .modern-transparent-card .fas {
        color: #05060793;  /* Icon color (can be changed) */
        margin-right: 5px;  /* Spacing between the icon and the text */
   }
</style>
<body>
@extends('layouts.master')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card modern-transparent-card">
                <div class="card-header">
                    <h4><i class="fas fa-clipboard-list"></i> รายละเอียด ขออนุมัติการลา</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('leave_applications.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> ชื่อ: {{ $employee->first_name }} {{ $employee->last_name }}
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">
                                <i class="fas fa-building"></i> แผนก: {{ $jobDetail->department ?? 'Not set' }}
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="reason" class="form-label"><i class="fas fa-info-circle"></i> รายละเอียด</label>
                            <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="from_date" class="form-label"><i class="fas fa-calendar-alt"></i> วันที่เริ่มต้น</label>
                            <input type="date" class="form-control" id="from_date" name="from_date">
                        </div>
                        <div class="mb-3">
                            <label for="to_date" class="form-label"><i class="fas fa-calendar-check"></i> วันที่สิ้นสุด</label>
                            <input type="date" class="form-control" id="to_date" name="to_date">
                        </div>
                        <div class="mb-3">
                            <label for="pdf_path" class="form-label"><i class="fas fa-paperclip"></i> ไฟล์แนบ</label>
                            <input type="file" class="form-control" id="pdf_path" name="pdf_path">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"></i> ส่ง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
@endsection
</body>

</html>
