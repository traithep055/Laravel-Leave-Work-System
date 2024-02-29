<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Session;
use DB;


class AttendaceController extends Controller
{
    public function show(){
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }

        $attendancePresent = DB::table('attendances')
        ->join('employees', 'attendances.emp_id', '=', 'employees.emp_id')
        ->where('attendances.status', 'Present')
        ->select('attendances.*', 'employees.first_name', 'employees.last_name')
        ->orderBy('date', 'desc')
        ->paginate(5);

         $attendanceOnLeave = DB::table('attendances')
        ->join('employees', 'attendances.emp_id', '=', 'employees.emp_id')
        ->where('attendances.status', 'On-Leave')
        ->select('attendances.*', 'employees.first_name', 'employees.last_name')
        ->orderBy('date', 'desc')
        ->paginate(5);

    return view('attendance', compact('data', 'attendancePresent', 'attendanceOnLeave'));
    }

}
