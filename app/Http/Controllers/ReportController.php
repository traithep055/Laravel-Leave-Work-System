<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employees;
use App\Models\Job_detail;
use App\Models\leave_applications;
use Illuminate\Support\Facades\Session;
use DB;
use PDF;

class ReportController extends Controller
{
    public function attendancereport(Request $request)
    {
        $data = null;

        $dates = Attendance::select('date')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->paginate(1); // แบ่งหน้าทีละ 1 วัน

        $selectedDate = $dates->first()->date ?? now()->format('Y-m-d');

        $attendanceDetails = Attendance::join('employees', 'attendances.emp_id', '=', 'employees.emp_id')
            ->join('job_details', 'job_details.emp_id', '=', 'employees.emp_id')
            ->select('attendances.date', 'attendances.emp_id', 'employees.first_name', 'employees.last_name', 'attendances.status', 'job_details.department')
            ->where('attendances.date', $selectedDate)
            ->get();

        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }

        return view('Report.attendancereport', compact('attendanceDetails', 'dates' , 'data'));
    }

    public function leaveworkreport()
    {   $data = null;
        $leavework = DB::table('leave_applications')
                       ->join('employees', 'leave_applications.emp_id', '=', 'employees.emp_id')
                       ->select('leave_applications.*', 'employees.first_name', 'employees.last_name')
                       ->paginate(8);

        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }

        return view('Report.Leavework', compact('leavework' , 'data'));
    }

    public function empreport()
    {   $data = null;
        $emp = DB::table('job_details')
        ->join('employees', 'job_details.emp_id', '=', 'employees.emp_id')
        ->select('job_details.*', 'employees.first_name', 'employees.last_name', 'employees.dob', 'employees.contact_number', 'employees.address')
        ->paginate(10); // Use paginate method

        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }



        return view('Report.reportemp', compact('emp' , 'data'));
    }

}
