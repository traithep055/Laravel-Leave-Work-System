<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    @extends('layouts.master')
    @section('content')
<div class="container mt-5">
    <div class="row">

        <!-- User Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">Manage all registered users.</p>
                    <a href="{{ route('user.index') }}" class="btn btn-primary">Go to Users</a>
                </div>
            </div>
        </div>
        <!-- Employee Card -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Employees</h5>
                    <p class="card-text">Manage all registered employees.</p>
                    <a href="{{ route('employee.index') }}" class="btn btn-primary">Go to Employees</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Job Details</h5>
                    <p class="card-text">Manage all registered Job Details of employees.</p>
                    <a href="{{ route('jobdetails-edit.index') }}" class="btn btn-primary">Job Details</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>


