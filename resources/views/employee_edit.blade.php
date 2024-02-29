<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
<style>
    <style>
    .sweetalert2-switch {
        display: block;
        width: 44px;
        height: 22px;
        margin: 10px auto;
        background-color: #e1e1e1;
        border-radius: 22px;
        position: relative;
        cursor: pointer;
    }
    .sweetalert2-switch:after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 20px;
        top: 1px;
        left: 1px;
        transition: left 0.2s;
    }
    .sweetalert2-checkbox:checked + .sweetalert2-switch:after {
        left: 23px;
    }
</style>
</style>
</head>
<body>
    <!-- resources/views/employee_edit.blade.php -->

@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h1>All Employees</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search Input -->
    <div class="mb-3">
        <form action="{{ route('employee.index') }}" method="get">

            <div class="input-group">
                <input type="text" name="search_id" class="form-control" placeholder="Search by Employee ID" value="{{ request('search_id') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Employees Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>User ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($searchedEmployee))
                <!-- Display the searched employee first -->
                <tr>
                    <td>{{ $searchedEmployee->emp_id }}</td>
                    <td>{{ $searchedEmployee->first_name }}</td>
                    <td>{{ $searchedEmployee->last_name }}</td>
                    <td>{{ $searchedEmployee->dob }}</td>
                    <td>{{ $searchedEmployee->contact_number }}</td>
                    <td>{{ $searchedEmployee->address }}</td>
                    <td>{{ $searchedEmployee->user_id }}</td>
                    <td>
                        <button class="btn btn-primary" onclick="window.location.href = '/employee/edit/{{ $searchedEmployee->emp_id }}'">Edit</button>
                        <form action="{{ route('employee.destroy', $searchedEmployee->emp_id) }}" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="button" onclick="confirmDelete({{ $searchedEmployee->emp_id }})">Delete</button>
                       </form>
                    </td>
                </tr>
            @endif

            @foreach($employees as $employee)
                @if(isset($searchedEmployee) && $employee->emp_id == $searchedEmployee->emp_id)
                    @continue
                @endif
                <tr>
                    <td>{{ $employee->emp_id }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->dob }}</td>
                    <td>{{ $employee->contact_number }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>{{ $employee->user_id }}</td>
                    <td>
                        <button class="btn btn-primary" onclick="window.location.href = '/employee/edit/{{ $employee->emp_id }}'">Edit</button>
                        <form action="{{ route('employee.destroy', $employee->emp_id) }}" method="post" style="display: inline;">
                             @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="button" onclick="confirmDelete(this)">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button onclick="window.location.href = '{{ route('employee.index') }}'" class="btn btn-info">Clear Form</button>
    <br>
    <br>
    <!-- Edit Form -->
    @if(isset($employeeToEdit))
    <h2>Edit Employee</h2>
    <form action="{{ route('employee.update', $employeeToEdit->emp_id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Employee ID:</label>
            <input type="text" name="emp_id" class="form-control" value="{{ $employeeToEdit->emp_id }}" required>
        </div>

        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" value="{{ $employeeToEdit->first_name }}" required>
        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" value="{{ $employeeToEdit->last_name }}" required>
        </div>

        <div class="form-group">
            <label>Date of Birth:</label>
            <input type="date" name="dob" class="form-control" value="{{ $employeeToEdit->dob }}" required>
        </div>

        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" value="{{ $employeeToEdit->contact_number }}" required>
        </div>

        <div class="form-group">
            <label>Address:</label>
            <input type="text" name="address" class="form-control" value="{{ $employeeToEdit->address }}" required>
        </div>

        <div class="form-group">
            <label>User ID:</label>
            <input type="text" name="user_id" class="form-control" value="{{ $employeeToEdit->user_id }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endif



</div>
<br>
<br><br>
<script>


    function findEmployee() {
        const empId = document.getElementById('searchEmpId').value;
        window.location.href = `/employee/edit/${empId}`;
    }
</script>
@endsection
<script>
    function confirmDelete(buttonElement) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover this user data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Delete',
        input: 'checkbox',
        inputValue: '1',
        inputPlaceholder: 'Toggle the switch to confirm',
        inputClass: 'sweetalert2-switch',
        customClass: {
            input: 'toggle-switch'
        },
        inputValidator: (result) => {
            return !result && 'You need to toggle the switch to delete!'
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            // Submit the form if the admin confirms and toggles the switch
            buttonElement.parentElement.submit();

        }

    });
}
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>
</html>
