<!DOCTYPE html>
<html lang="en">

<head>
    <title>AdminHome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        * {
            font-family: 'Kanit', sans-serif;
        }

        .navbar-dark {
            background-color: #222;
        }

        .logout-btn {
            margin-left: auto;
        }

        .navbar {
            background-color: ##FF416C;  /* Dark Blue */
            transition: background-color 3s, box-shadow 3s;
            /* box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); */
        }

        .navbar:hover {
            background-color: ##FF4B2B;  /* Slightly Brighter Blue on Hover */
        }

        .navbar-brand,
        .nav-link {
            color: #E9F1F7 !important;  /* Light blue-grey for text */
            margin-right: 15px;
            transition: color 0.3s;
        }

        .navbar-brand:hover,
        .nav-link:hover {
            color: #FFFFFF !important;  /* Pure white on hover */
        }

        .navbar-toggler {
            border-color: #E9F1F7;  /* Light blue-grey for the toggler */
        }

        .navbar-toggler-icon {
            background-color: #E9F1F7;  /* Light blue-grey for the toggler icon */
        }

        .dropdown-item:hover {
            background-color: rgba(15, 102, 150, 0.7);  /* Slightly Brighter Blue for dropdown hover */
            color: #FFFFFF;
        }

        .nav-link:hover {
            color: #FFFFFF !important;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 5px 10px;
        }

        .dropdown-menu {
            border: none;  /* Remove the default border */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);  /* Add a subtle shadow for depth */
            border-radius: 5px;  /* Round the corners */
        }

        .dropdown-item {
            padding: 10px 20px;  /* Spacious padding */
            font-weight: 500;  /* Semi-bold font */
            transition: background-color 0.3s, color 0.3s;  /* Smooth color transition */
        }

        .dropdown-item:hover {
            background-color: #1a355c;  /* Darker blue on hover */
            color: #FFFFFF;  /* White text on hover */
        }

        .dropdown-divider {
            margin: 5px 0;  /* Space out the divider more */
        }
        html, body {
    height: 100%;
}
.psm-image {
    width: 80%; /* ปรับเป็น 80% จากความกว้างเต็ม cell */
    height: auto; /* ความสูงของรูปภาพจะปรับตามความกว้าง */
    max-height: 80px; /* ปรับความสูงสูงสุดเป็น 80px */
    display: block; /* ทำให้รูปภาพอยู่ตรงกลางของ cell */
    margin: 0 auto; /* จัดให้รูปภาพอยู่ตรงกลางแนวนอนของ cell */
}
.profile-picnav {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 5px;
            margin-right: 10px;
        }
    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ (isset($data) && $data->role == 'employee') ? route('index') : route('dashboard') }}">
                <img src="https://cdn.pic.in.th/file/picinth/-1_preview_rev_15beae3dcd532a37b.png" alt="PSM Image" class="psm-image">
            </a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar"
                aria-controls="myNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    {{-- @if ($user_role === 'admin')
                    <li class="nav-item active"><a class="nav-link" href="{{route('all-system.index')}}">หน้ารวมระบบ A</a></li>
                    @endif --}}
                     @if ($user_role === 'employee' || $user_role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{route('empdata.show')}}">ข้อมูลพนักงาน   </a></li>
                    @endif
                    @if ($user_role === 'employee' || $user_role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{route('adttendancereport.show')}}">รายงานการเข้างานประจำวัน </a></li>
                    @endif
                    {{-- @if ($user_role === 'admin')
                    <li class="nav-item"><a class="nav-link" href="{{route('attendance.show')}}">ตรวจสอบคนเข้างาน A</a></li>
                    @endif --}}
                    @if ($user_role === 'employee')

                    <li class="nav-item"><a class="nav-link" href="{{route('leave_applications.create')}}">กรอกฟอร์มขอลา </a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('emp.leaves')}}">คำขอลาของพนักงาน </a></li>
                    @endif

                    @if ($user_role === 'admin')
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="checkDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            ตรวจสอบ
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="checkDropdown">
                            <li><a class="dropdown-item" href="{{route('attendance.show')}}">ตรวจสอบและจัดการข้อมูลการเข้างานของพนักงาน</a>
                            </li>
                            <li><a class="dropdown-item" href="{{route('leave_applications.show')}}">ตรวจสอบและอนุมัติคำขอลาของพนักงาน</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($user_role === 'admin')
                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            รายงาน
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('adttendancereport.show')}}">รายงานการเข้างานประจำวัน</a></li>
                            <li><a class="dropdown-item" href="{{route('leavereport.show')}}">รายงานคำขอลา</a></li>
                            <li><a class="dropdown-item" href="{{route('empreport.show')}}">รายงานพนักงานทั้งหมด</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        @if (isset($data) && $data)
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/' . $data->profile_picture) }}" alt="Profile Picture"
                                    class="profile-picnav">
                            <i class=""></i> {{ $data->first_name }} {{ $data->last_name }}
                        </a>
                        <!-- Dropdown for user-related links (optional) -->
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{route('profile.edit')}}">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    @endif

                    </li>
                </ul>

            </div>
        </div>
    </nav>



    <!-- Bootstrap 5 JS (including Popper.js for dropdowns) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
