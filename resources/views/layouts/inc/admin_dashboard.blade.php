<!--
=========================================================
* Material Dashboard 2 - v3.1.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
  <title>
    Master Template
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('css/material-dashboard.css?v=3.1.0')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  <style>
    body {
        background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
    }

    .container {
        background-color: #f2f2f2;
        border-radius: 5px;
        padding: 20px;
    }

    .chart-container {
        width: 38%;
        margin: 0 auto; 
        /* margin-top: 20px; เพิ่มระยะห่างด้านบน */
    }

    #myChart {
        display: block;
        max-width: 100%;
        height: auto;
    }

    .card {
        background-color: #ffffff; /* กำหนดสีพื้นหลังเป็นสีขาว */
        border: none; /* ลบเส้นขอบ */
    }
    .profile-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }


        .form-label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 20px;
        }


</style>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand" href="#">
        <img src="https://cdn.pic.in.th/file/picinth/-1_preview_rev_15beae3dcd532a37b.png" alt="PSM Image" class="psm-image">
        <span>PSM</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="{{ (isset($data) && $data->role == 'employee') ? route('index') : route('dashboard') }}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{route('empdata.show')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user"></i>
            </div>
            <span class="nav-link-text ms-1">ข้อมูลพนักงาน</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="{{route('adttendancereport.show')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">รายงานการเข้างานประจำวัน</span>
          </a>
        </li>

        @if ($user_role === 'admin')
        <li class="nav-item dropdown">
          <a class="nav-link text-white " href="{{route('attendance.show')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">จัดการข้อมูลการเข้างาน</span>
          </a>
        </li>
        @endif
        
        @if ($user_role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-white " href="{{route('leave_applications.show')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                
                <i class="fa fa-door-open"></i>
                {{-- <i class="material-icons opacity-10">view_in_ar</i> --}}
            </div>
            <span class="nav-link-text ms-1">อนุมัติคำขอลาของพนักงาน</span>
          </a>
        </li>
        @endif

        @if ($user_role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-white " href="{{route('adttendancereport.show')}}">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">view_in_ar</i>
            </div>
            <span class="nav-link-text ms-1">รายงานการเข้างานประจำวัน</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{route('leavereport.show')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">format_textdirection_r_to_l</i>
              </div>
              <span class="nav-link-text ms-1">รายงานคำขอลา</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white " href="{{route('empreport.show')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-file-pdf"></i>
              </div>
              <span class="nav-link-text ms-1">รายงานพนักงานทั้งหมด</span>
            </a>
          </li>  
        @endif

        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Account pages</h6>
        </li>

        <li class="nav-item">
            @if (isset($data) && $data)
            <a class="nav-link" href="#" id="userDropdown">
            <img src="{{ asset('storage/' . $data->profile_picture) }}" alt="Profile"
                    class="profile-picnav">
            <i class=""></i> {{ $data->first_name }} {{ $data->last_name }}
            </a>
            @endif
        </li>
        <li class="nav-item">
            <a class="nav-link text-white " href="{{route('profile.edit')}}">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-regular fa-address-card"></i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li> 
        <li class="nav-item">
            <a class="nav-link text-white " href="{{ route('logout') }}">
                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-sign-out-alt"></i>
                </div>
                <span class="nav-link-text ms-1">Logout</span>
            </a>
        </li>
        
      </ul>
    </div>
    
  </aside>
  
  <main class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        
      </div>
    </nav>
    <!-- End Navbar -->
    {{-- <div class="container"> --}}

        @yield('content')
    
    {{-- </div> --}}
  </main>
  
  <!--   Core JS Files   -->
  <script src="{{asset('js/core/popper.min.js')}}"></script>
  <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('js/plugins/chartjs.min.js')}}"></script>

  
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-dashboard.min.js?v=3.1.0')}}"></script>
</body>

</html>