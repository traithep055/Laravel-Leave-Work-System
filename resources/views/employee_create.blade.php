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
<div class="container mt-5">
    <h2>Add New Employee</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('employee.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Employee ID:</label>
            <input type="text" name="emp_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="dob" class="form-control">
        </div>
        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" name="contact_number" class="form-control">
        </div>
        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label>User ID:</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>
@endsection

</body>
</html>
