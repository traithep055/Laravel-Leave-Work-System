<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
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

<body>
    @extends('layouts.master')
    @section('content')
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="profile-container">
                        <div class="row">
                            <!-- Profile Picture and Upload -->
                            <div class="col-md-4 text-center">
                                <img src="{{ asset('storage/' . $data->profile_picture) }}" alt="Profile Picture"
                                    class="profile-pic">

                                    <p><strong><i class="fas fa-envelope"></i> :</strong> {{ $data->email }}</p>
                                    <p><strong><i class="fas fa-building"></i> :</strong> {{ $data->department }}</p>
                                    <p><strong><i class="fas fa-phone"></i> :</strong> {{ $data->contact_number }}</p>

                            </div>
                            <!-- User Data -->
                            <div class="col-md-8">
                                <h3 class="mb-4">{{ $data->first_name }} {{ $data->last_name }}</h3>
                                <label for="username" class="form-label"><i class="fas fa-user"></i> User ID</label>
                                <input type="text" id="username" class="form-control" value="{{ $data->user_id }}"
                                    readonly>

                                <label for="username" class="form-label"><i class="fas fa-id-badge"></i> Employee ID</label>
                                <input type="text" id="username" class="form-control" value="{{ $data->emp_id }}"
                                    readonly>

                                <label for="fullname" class="form-label"><i class="fas fa-user"></i> Full name</label>
                                <input type="text" id="fullname" class="form-control"
                                    value="{{ $data->first_name }} {{ $data->last_name }}" readonly>

                                <label for="fullname" class="form-label"><i class="fas fa-calendar"></i> Date Of
                                    Birth</label>
                                <input type="text" id="fullname" class="form-control" value="{{ $data->dob }}"
                                    readonly>

                                <label for="title" class="form-label"><i class="fas fa-user-tie"></i> Title</label>
                                <input type="text" id="title" class="form-control" value="{{ $data->role }}"
                                    readonly>

                                <label for="language" class="form-label"><i class="fas fa-language"></i> Language</label>
                                <input type="text" id="title" class="form-control" value="Thai" readonly>

                                <label for="language" class="form-label"><i class="fas fa-map-marker-alt"></i>
                                    Address</label>
                                <input type="text" id="title" class="form-control" value="{{ $data->address }}"
                                    readonly>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</body>

</html>
