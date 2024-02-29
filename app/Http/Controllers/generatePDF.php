<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employees;
use App\Models\Job_detail;
use App\Models\leave_applications;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use DB;

class generatePDF extends Controller
{
    public function generatePDF() {
        $attendanceDetails = Attendance::join('employees', 'attendances.emp_id', '=', 'employees.emp_id')
            ->join('job_details', 'job_details.emp_id', '=', 'employees.emp_id')
            ->select('attendances.date', 'attendances.emp_id', 'employees.first_name', 'employees.last_name', 'attendances.status', 'job_details.department')
            ->get();

        // Return the view with data
        return view('generatePDF.printpdf', ['attendanceDetails' => $attendanceDetails]);
    }

    public function generatePDF2() {
        $leaveApplications = DB::table('leave_applications')
            ->join('employees', 'leave_applications.emp_id', '=', 'employees.emp_id')
            ->select('leave_applications.from_date', 'leave_applications.to_date', 'leave_applications.reason', 'leave_applications.status', 'employees.emp_id', 'employees.first_name', 'employees.last_name')
            ->get();

        // Return the view with data
        return view('generatePDF.printpdf2', ['leavework' => $leaveApplications]);
    }

    public function generatePDF3() {
        $employees = DB::table('employees')
            ->join('job_details', 'job_details.emp_id', '=', 'employees.emp_id')
            ->select('employees.*', 'job_details.*')  // selecting all columns from both tables
            ->get();

        // Return the view with data
        return view('generatePDF.printpdf3', ['emp' => $employees]);
    }


}
