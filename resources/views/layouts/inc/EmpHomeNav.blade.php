<!DOCTYPE html>
<html lang="en">
<head>
  <title>EmpHome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit&display=swap');
    *{font-family: 'Kanit', sans-serif;}
    .logout{
      padding: 10px 0;
      display: flex;
      justify-content: flex-end;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Employee</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">หน้า Dashboard</a></li>
      <li><a href="{{ url('#') }}">ข้อมูลส่วนพนักงาน</a></li>
      <li><a href="{{ url('#') }}">ตรวจสอบข้อมูลการเข้างานของพนักงาน</a></li>
      <li><a href="{{ url('#') }}">คำขอลาของพนักงาน </a></li>
    </ul>
   <div class="logout">
    <form action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger" type="submit" >Logout</button>
  </form>
   </div>
  </div>
</nav>



</body>
</html>

