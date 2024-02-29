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
    <h1>Add New User</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label>User ID:</label>
            <input type="text" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Role:</label>
            <input type="text" name="role" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection

</body>
</html>
