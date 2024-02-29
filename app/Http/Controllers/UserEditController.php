<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employees;
use Illuminate\Support\Facades\Session;
use DB;
class UserEditController extends Controller
{

    public function create()
    {
        return view('user_create');  // This will render the user_create.blade.php view.
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:users,user_id',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = new User;
        $user->user_id = $request->user_id;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;
        $user->save();

        // Assuming you only want to create an employee for users with role 'employee'
        if ($request->role === 'employee' || 'admin') {
            // Generate a unique emp_id
            $latestEmployee = Employees::orderBy('emp_id', 'desc')->first();
            $latestEmpId = $latestEmployee ? intval(substr($latestEmployee->emp_id, 3)) : 0;
            $newEmpId = 'EMP' . str_pad($latestEmpId + 1, 3, '0', STR_PAD_LEFT);

            $newEmployee = new Employees();
            $newEmployee->emp_id = $newEmpId;
            $newEmployee->user_id = $request->user_id;
            // You can add other fields here as necessary
            $newEmployee->save();
        }

        return redirect()->route('user.index')->with('success', 'User added successfully!');
    }



    public function index(Request $request)
    {   $data = null;
        $users = User::all();
        $searchedUser = null;  // Initialize as null
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            // Validate the user_id from the session



            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }
        if ($request->has('search_id')) {
            $searchedUser = User::find($request->search_id);
        }

        return view('user_edit', compact('users', 'searchedUser' , 'data'));
    }


    public function edit($user_id)
    {
        $userToEdit = User::findOrFail($user_id);   // The user you want to edit
        $users = User::all();   // All users
        $searchedUser = null;   // This will default to null, as we're not searching in this context

        return view('user_edit', compact('userToEdit', 'users', 'searchedUser'));
    }


    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        // Validate the request data
        $request->validate([
            'user_id' => 'required|unique:users,user_id,' . $user->user_id . ',user_id', // <-- Note the change here
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id', // <-- And here
            'password' => 'sometimes',
            'role' => 'required'
        ]);

        // Update the user fields
        $user->user_id = $request->user_id;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);  // Remember to hash the password
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully!');
    }

    public function destroy($user_id)
    {
        User::findOrFail($user_id)->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully!');
    }
}
