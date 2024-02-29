<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
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
    .btntohide{

    }

</style>
</head>
<body>
    <!-- resources/views/user_edit.blade.php -->

    @extends('layouts.master')

    @section('content')
    <div class="container mt-5">
        <h1>All Users</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Input -->
        <div class="mb-3">
            <form action="{{ route('user.index') }}" method="get">
                <div class="mb-3">
                <!-- <button type="button" onclick="showCreateForm()" class="btn btn-success mb-2">Add User</button> -->

                </div>
                <div class="input-group">
                    <input type="text" name="search_id" class="form-control" placeholder="Search by user ID" value="{{ request('search_id') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($searchedUser)
                    <!-- Display the searched user first -->
                    <tr>
                        <td>{{ $searchedUser->user_id }}</td>
                        <td>{{ $searchedUser->email }}</td>
                        <td>{{ $searchedUser->role }}</td>
                        <td>

                        <button class="btn btn-primary" onclick="window.location.href = '/user/edit/{{ $searchedUser->user_id }}'">Edit</button>
                            <form action="{{ route('user.destroy', $searchedUser->user_id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif

                @foreach($users as $user)
                    @if($searchedUser && $user->user_id == $searchedUser->user_id)
                        @continue  <!-- Skip the searched user because it's already displayed -->
                    @endif
                    <tr>
                        <td>{{ $user->user_id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                        <button class="btn btn-primary" onclick="window.location.href = '/user/edit/{{ $user->user_id }}'">Edit</button>
                        <!-- <button class="btn btn-primary" onclick="confirmEdit('/user/edit/{{ $user->user_id }}')">Edit</button> -->
                            <form action="{{ route('user.destroy', $user->user_id) }}" method="post" style="display: inline;">
                            @csrf
                             @method('DELETE')
                            <button class="btn btn-danger" type="button" onclick="confirmDelete(this)">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button onclick="window.location.href = '{{ route('user.index') }}'" class="btn btn-info">Clear Form</button>


        <!-- Edit Form -->

        @if(isset($userToEdit))
        <h2>Edit User</h2>
        <form action="{{ route('user.update', $userToEdit->user_id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group" >
                <label>User ID:</label>
                <input type="text" name="user_id" class="form-control" value="{{ $userToEdit->user_id }}" required>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="{{ $userToEdit->email }}" required>
            </div>
            <div class="form-group">
                <label>Password (leave empty to keep unchanged):</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Role:</label>
                <input type="text" name="role" class="form-control" value="{{ $userToEdit->role }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
        @endif


        <!-- Create User Form -->
        <div id="createUserForm" style="display: none;">
    <h2>Create New User</h2>
    <form id="userCreationForm" action="{{ route('user.store') }}" method="post">
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
    </form>
</div>
    <!-- <div id="createUserForm" style="display: block;">
        <h2>Create New User</h2>
        <form  id="createUserForm" action="{{ route('user.store') }}" method="post">
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
        <button class="btn btn-success" onclick="showCreateUserForm()">Create User</button> -->
        </form>
        <!-- <button class="btn btn-success" onclick="showCreateUserForm()">Create User</button> -->
    </div>
    <div style="display: flex; justify-content: center; align-items: center; height: 5vh;">
    <div class="btntohide">
        <button class="btn btn-success" onclick="showCreateUserForm()">Create User</button>
    </div>
</div>

</div>
    </div>
    @endsection

<script>
    function showCreateForm() {
    const form = document.getElementById('createUserForm');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

    function findUser() {
        const userId = document.getElementById('searchUserId').value;
        // You can perform an AJAX call here or simply navigate to a route to fetch the user data.
        // For simplicity, we will just navigate:
        window.location.href = `/user/edit/${userId}`;
    }

    function editUser(userId) {
        window.location.href = `/user/edit/${userId}`;
    }
</script>
<script>
    function confirmDelete(buttonElement) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Once deleted, you will not be able to recover this user data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'No',
        confirmButtonText: 'Yes, delete it!',
        input: 'checkbox',
        inputValue: '1',
        inputPlaceholder: 'Check the box to confirm',
        inputValidator: (result) => {
            return !result && 'You need to check the box to delete!'
        }
    }).then((result) => {
        if (result.isConfirmed && result.value) {
            // Submit the form if the admin confirms and checks the box
            buttonElement.parentElement.submit();
        }
    });
}
</script>
<script>
//    function showCreateUserForm() {
//     Swal.fire({

//         html: document.getElementById('createUserForm').outerHTML,
//         showCloseButton: true,
//         showCancelButton: true,
//         focusConfirm: false,
//         confirmButtonText: 'Create User',
//         cancelButtonText: 'Cancel',
//         preConfirm: () => {
//             const form = Swal.getPopup().querySelector('form');
//             form.submit();
//         }
//     });
// }
</script>
<script>
    function showCreateForm() {
        const form = document.getElementById('createUserForm');
        form.style.display = 'block'; // Show the form
    }

    function showCreateUserForm() {
        const form = document.getElementById('userCreationForm');

        Swal.fire({
            html: form.outerHTML,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: 'Create User',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const formInPopup = Swal.getPopup().querySelector('form');
                formInPopup.submit();
            }
        });
    }
</script>


<script>
    function showEditUserForm() {
    const formContent = document.getElementById('editUserForm').outerHTML;

    Swal.fire({
        title: 'Edit User',
        html: formContent,
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Update',
        cancelButtonText: 'Cancel',
        preConfirm: () => {
            const formInPopup = Swal.getPopup().querySelector('#editUserForm form');
            formInPopup.submit();
        }
    });
}

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.all.min.js"></script>
</body>
</html>
