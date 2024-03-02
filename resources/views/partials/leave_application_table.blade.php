<!-- resources/views/partials/leave_application_table.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .btn{
            margin-top: 12px
        }
    </style>
</head>
<body>
    <div class="card shadow mb-4"> <!-- ใส่ card และ shadow สำหรับ Bootstrap -->
    <div class="card-header py-3 bg-dark text-white"> <!-- เพิ่ม bg-dark และ text-white ที่นี่ -->
        <h6 class="m-0 font-weight-bold">ข้อมูลการลา</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ นามสกุล</th>
                    <th>ตั้งแต่วันที่</th>
                    <th>ถึงวันที่</th>
                    <th>เหตุผล</th>
                    <th>คำขอ</th>
                    <th>ใบขออนุญาติลา</th>
                    <th>สาเหตุ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $application->leave_applications_id }}</td>
                        <td>{{ $application->emp_id }}</td>
                        <td>{{ $application->employee->first_name }} {{ $application->employee->last_name }}</td>
                        <td>{{ $application->from_date }}</td>
                        <td>{{ $application->to_date }}</td>
                        <td>{{ $application->reason }}</td>
                        <td>
                            @if (empty($application->status))
                                {{-- <a href="{{ route('leave_applications.approve', $application->leave_applications_id) }}" class="btn btn-sm btn-success">อนุมัติ</a> --}}
                                <form action="{{ route('leave_applications.approve', $application->leave_applications_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="cause"> <!-- เพิ่ม input field สำหรับคำอธิบายการอนุมัติ -->
                                    <button type="submit" class="btn btn-sm btn-success">อนุมัติ</button> <!-- ปุ่มสำหรับ submit การอนุมัติ -->
                                </form>
                                {{-- <a href="{{ route('leave_applications.decline', $application->leave_applications_id) }}" class="btn btn-sm btn-danger">ปฏิเสธ</a> --}}
                                <form action="{{ route('leave_applications.decline', $application->leave_applications_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="cause"> <!-- เพิ่ม input field สำหรับคำอธิบายการอนุมัติ -->
                                    <button type="submit" class="btn btn-sm btn-danger">ปฏิเสธ</button> <!-- ปุ่มสำหรับ submit การอนุมัติ -->
                                </form>
                            @else
                                {{ $application->status }}
                            @endif
                        </td>
                        <td>
                            @if ($application->pdf_path)
                                <a href="{{ route('leaveApplications.download', $application->leave_applications_id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-download"></i> ดาวน์โหลดไฟล์
                                </a>
                            @endif
                        </td>
                        <td>
                            {{ $application->cause }}
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

