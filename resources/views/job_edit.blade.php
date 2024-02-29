<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job Details Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.1.9/sweetalert2.all.min.js"></script>
</head>

<body>
    @extends('layouts.master')

    @section('content')
    <div class="container mt-5">
        <h1>All Job Details</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('fail'))
        <div class="alert alert-danger">
            {{ session('fail') }}
        </div>
    @endif

        <!-- Search Input -->
        <div class="mb-3">
            <form action="{{ route('jobdetails-edit.index') }}" method="get">
                <div class="mb-3">
                    <button type="button" onclick="showCreateForm()" class="btn btn-success mb-2">Add Job Details</button>
                </div>
                <div class="input-group">
                    <input type="text" name="search_id" class="form-control" placeholder="Search by EMP ID" value="{{ request('search_id') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Job Details Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Department</th>
                    <th>Joining Date</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @if(isset($searchedJob_details) && $searchedJob_details)
                <tr>
                <td>{{ $searchedJob_details->emp_id }}</td>
                <td>{{ $searchedJob_details->department }}</td>
                <td>{{ $searchedJob_details->joining_date }}</td>
                <td>{{ $searchedJob_details->salary }}</td>
                <td>
                <button class="btn btn-primary" onclick="window.location.href = '/jobdetails-edit/edit/{{ $searchedJob_details->job_id }}'">Edit</button>
                 <form action="{{ route('jobdetails-edit.destroy', $searchedJob_details->job_id) }}" method="post" style="display: inline;" onsubmit="return confirmDelete({{ $searchedJob_details->job_id }});">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
    </tr>
            @endif
                @foreach($job_details as $jobDetail)
                @if(isset($searchedJob_details) && $jobDetail->job_id == $searchedJob_details->job_id)
                @continue <!-- Skip the searched details because it's already displayed -->
                @endif
                <tr>
                    <td>{{ $jobDetail->emp_id }}</td>
                    <td>{{ $jobDetail->department }}</td>
                    <td>{{ $jobDetail->joining_date }}</td>
                    <td>{{ $jobDetail->salary }}</td>
                    <td>
                        <a href="{{ route('jobdetails-edit.edit', $jobDetail->job_id) }}" class="btn btn-primary">Edit</a>

                        <form action="{{ route('jobdetails-edit.destroy', $jobDetail->job_id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="button" onclick="confirmDelete({{ $jobDetail->job_id }})">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button onclick="window.location.href = '{{ route('jobdetails-edit.index') }}'" class="btn btn-info">Clear Form</button>

        <!-- Edit Form -->
        @if(isset($jobDetailsToEdit))
        <h2>Edit Job Details</h2>
        <form action="{{ route('jobdetails-edit.update', $jobDetailsToEdit->job_id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Employee ID:</label>
                <input type="text" name="emp_id" class="form-control" value="{{ $jobDetailsToEdit->emp_id }}" required>
            </div>
            <div class="form-group">
                <label>Department:</label>
                <select name="department" class="form-control" required>
                    <option value="Software Development" {{ $jobDetailsToEdit->department == 'Software Development' ? 'selected' : '' }}>Software Development</option>
                    <option value="IT Support or Helpdesk" {{ $jobDetailsToEdit->department == 'IT Support or Helpdesk' ? 'selected' : '' }}>IT Support or Helpdesk</option>
                    <option value="Network" {{ $jobDetailsToEdit->department == 'Network' ? 'selected' : '' }}>Network</option>
                    <option value="Cybersecurity" {{ $jobDetailsToEdit->department == 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                    <option value="Database Administration" {{ $jobDetailsToEdit->department == 'Database Administration' ? 'selected' : '' }}>Database Administration</option>
                </select>
            </div>

            <div class="form-group">
                <label>Joining Date:</label>
                <input type="date" name="joining_date" class="form-control" value="{{ $jobDetailsToEdit->joining_date }}" required>
            </div>
            <div class="form-group">
                <label>Salary:</label>
                <input type="text" name="salary" class="form-control" value="{{ $jobDetailsToEdit->salary }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Job Details</button>
        </form>
        @endif

        <!-- Create Job Details Form -->
        <div id="createJobDetailsForm" style="display:none;">
            <h2>Create New Job Details</h2>
            <form action="{{ route('jobdetails-edit.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>Employee ID:</label>
                    <select name="emp_id" class="form-control" required>
                        @foreach($availableEmployees as $employee)
                            <option value="{{ $employee->emp_id }}">
                                {{ $employee->emp_id }} - {{ $employee->first_name }} {{ $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Department:</label>
                    <select name="department" class="form-control" required>
                        <option value="Software Development">Software Development</option>
                        <option value="IT Support or Helpdesk">IT Support or Helpdesk</option>
                        <option value="Network">Network</option>
                        <option value="Cybersecurity">Cybersecurity</option>
                        <option value="Database Administration">Database Administration</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Joining Date:</label>
                    <input type="date" name="joining_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Salary:</label>
                    <input type="text" name="salary" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Job Details</button>
            </form>
        </div>
    </div>

    <script>
        function showCreateForm() {
            const form = document.getElementById('createJobDetailsForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function confirmDelete(job_id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector(`form[action$="/jobdetails-edit/${job_id}"]`).submit();
                }
            });
        }
    </script>

    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>
