<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Activity | Activities</title>
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
  </style>

</head>

<body>

    <div class="container">
        <div class="report-title">
            <br><br>
            <h1>รายงานพนักงานตามแผนก</h1><br>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th >รหัสพนักงาน</th>
                    <th >ชื่อ</th>
                    <th >นามสกุล</th>
                    <th >แผนก</th>
                    <th >วันที่</th>
                    <th >สถานะการเข้างาน</th>
            </thead>
            <tbody>
                <tr>
                    <td>78</td>
                    <td>ขอบภพ</td>
                    <td>ซาเสม</td>
                    <td>ไอทีซับ</td>
                    <td>ซ่อมบำรุง</td>
                    <td>7/10/2566</td>
                    <td>เข้างานแล้ว</td>
                </tr>
                <tr>
                    <td>78</td>
                    <td>ขอบภพ</td>
                    <td>ซาเสม</td>
                    <td>ไอทีซับ</td>
                    <td>ซ่อมบำรุง</td>
                    <td>7/10/2566</td>
                    <td>เข้างานแล้ว</td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap 5's CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


</body>
</html>

