<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @extends('layouts.master')

    @section('content')
    <h1>Edit Leave Application</h1>

    <form action="{{ route('leaveapp.update', $leaveApplication->leave_applications_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Employee ID:</label>
            <input type="text" name="emp_id" value="{{ $leaveApplication->emp_id }}" required>
        </div>

        <div>
            <label>From Date:</label>
            <input type="date" name="from_date" value="{{ $leaveApplication->from_date }}" required>
        </div>

        <div>
            <label>To Date:</label>
            <input type="date" name="to_date" value="{{ $leaveApplication->to_date }}" required>
        </div>

        <div>
            <label>Reason:</label>
            <textarea name="reason" required>{{ $leaveApplication->reason }}</textarea>
        </div>

        <div>
            <label>Status:</label>
            <select name="status" required>
                <option value="Pending" {{ $leaveApplication->status == 'รอการอนุมัติ' ? 'selected' : '' }}>รอการอนุมัติ</option>
                <option value="Approved" {{ $leaveApplication->status == 'อนุมัติ' ? 'selected' : '' }}>อนุมัติ</option>
                <option value="Rejected" {{ $leaveApplication->status == 'ปฏิเสธ' ? 'selected' : '' }}>ปฏิเสธ</option>
            </select>
        </div>

        <div>
            <label>Upload PDF (if you want to update it):</label>
            <input type="file" name="pdf_path">
            @if($leaveApplication->pdf_path)
                <a href="{{ asset('storage/'.$leaveApplication->pdf_path) }}" target="_blank" download>Download Current PDF</a>
            @endif
        </div>


        <button type="submit">Update</button>
    </form>

    <form action="{{ route('leaveapp.destroy', $leaveApplication->leave_applications_id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>

    @endsection


</body>
</html>
