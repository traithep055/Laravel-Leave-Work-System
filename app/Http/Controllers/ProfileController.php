<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use App\Models\Employees;

class ProfileController extends Controller
{
    public function show(){

        if (Session::has('loginUser')) {
            $userId = Session::get('loginUser');

            $data = DB::table('users')
                    ->join('employees', 'users.user_id', '=', 'employees.user_id')
                    ->where('users.user_id', $userId)
                    ->select('users.*', 'employees.*')
                    ->first();

            return view('profile.profileEdit' ,compact('data'));
        } else {
            // Handle the case where there's no logged-in user
            return redirect('login')->with('fail', 'Please login first.');
        }
    }


    public function update(Request $request)
    {
        // Validation rules, add 'image' rule for the profile picture
        $request->validate([
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max file size 2MB
        ]);

        $user_id = Session::get('loginUser');

        // Get the existing employee record based on user_id
        $existingEmployee = Employees::where('user_id', $user_id)->first();

        if ($existingEmployee) {
            // Handle profile picture upload
            if ($request->has('profile_picture')) {
                $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
                $existingEmployee->profile_picture = $imagePath; // Update the profile_picture field in the database
            }

            // Update other fields
            $existingEmployee->first_name = $request->input('first_name');
            $existingEmployee->last_name = $request->input('last_name');
            $existingEmployee->dob = $request->input('dob');
            $existingEmployee->contact_number = $request->input('contact_number');
            $existingEmployee->address = $request->input('address');

            $existingEmployee->save(); // Save the updated record

            return back()->with('success', 'Employee updated successfully!');
        } else {
            // Handle the case where there's no employee record for this user (if needed)
            return back()->with('error', 'Employee not found!');
        }
    }






}
