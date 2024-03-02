<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)), url('https://cdn.pic.in.th/file/picinth/bg-masthead.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Kanit', sans-serif;
        }

        .custom-header {
            background-color: #2c2c2c !important;
            color: #f7f7f7; /* Text color */
            padding: 20px; /* Add padding for spacing */
            border-radius: 5px; /* Add rounded corners */
        }

        .custom-header h1 {
            font-size: 24px; /* Adjust font size as needed */
            margin-bottom: 0; /* Remove default margin */
        }

        .card {
            border: none; /* Remove card border */
            border-radius: 10px; /* Add rounded corners to the card */
        }

        .form-control {
            border-radius: 5px; /* Add rounded corners to form controls */
        }
        .card {
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1); /* Adjust the shadow values as needed */
        }
    </style>
</head>
<body>
{{-- @extends('layouts.master') --}}
@extends('layouts.inc.admin_dashboard')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header custom-header">
                    <h1 class="mb-0" style="color: #f7f7f7">Update Profile</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $data->first_name }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data->last_name }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                <input type="date" class="form-control" id="dob" name="dob" value="{{ $data->dob }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $data->contact_number }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-image"></i></span>
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Update Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
</body>
</html>
