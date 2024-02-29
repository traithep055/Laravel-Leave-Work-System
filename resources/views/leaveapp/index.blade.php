<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    @extends('layouts.master')

@section('content')
<h1 class="mb-4">Leave Applications</h1>

<div class="card">
    <div class="card-header">
        List of Applications
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>From Date</th>
                    <th>To Date</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaveApplications as $application)
                    <tr>
                        <td>{{ $application->emp_id }}</td>
                        <td>{{ $application->from_date }}</td>
                        <td>{{ $application->to_date }}</td>
                        <td>{{ $application->reason }}</td>
                        <td>{{ $application->status }}</td>
                        <td>
                            @if($application->pdf_path)
                                <a href="{{ asset('storage/'.$application->pdf_path) }}" target="_blank">View PDF</a>
                            @else
                                No PDF uploaded
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('leaveapp.edit', $application->leave_applications_id) }}" class="btn btn-primary">Edit</a>

                            <form action="{{ route('leaveapp.destroy', $application->leave_applications_id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection



</body>
</html>
