<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leave_applications;
use App\Models\Employees;
use App\Models\Job_details;
use Illuminate\Support\Facades\Session;
use DB;

class LeaveApplicationController extends Controller
{


    public function show() {
        $leaveApplications = leave_applications::with('employee', 'employee.jobDetail')->get();
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            // Validate the user_id from the session



            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }


        return view('leave_applications_show', compact('leaveApplications','data'));
    }

    public function empLeaves() {
        $user_id = Session::get('loginUser');
        $employee = Employees::where('user_id', $user_id)->first();

        if(!$employee) {
            return view('error')->with('message', 'Employee not found for the logged-in user');
        }

        $leaveApplications = leave_applications::where('emp_id', $employee->emp_id)->get();


        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            // Validate the user_id from the session



            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }


        return view('emp_leaves', compact('leaveApplications', 'data'));
    }

    // public function approve(Request $request, $leave_applications_id)
    // {
    //     $leaveApplication = leave_applications::find($leave_applications_id);
    //     if ($leaveApplication) {
    //         $leaveApplication->status = "อนุมัติ";
    //         $leaveApplication->cause = $request->reason; // เก็บเหตุผลลงในฐานข้อมูล
    //         $leaveApplication->save();
    //         Session::flash('success', 'Leave application approved successfully!');
    //     } else {
    //         Session::flash('error', 'Leave application not found.');
    //     }
    //     return redirect()->route('leave_applications.show');
    // }

    // public function decline(Request $request, $leave_applications_id)
    // {
    //     $leaveApplication = leave_applications::find($leave_applications_id);
    //     if ($leaveApplication) {
    //         $leaveApplication->status = "ปฏิเสธ";
    //         $leaveApplication->cause = $request->reason; // เก็บเหตุผลลงในฐานข้อมูล
    //         $leaveApplication->save();
    //         Session::flash('success', 'Leave application declined successfully!');
    //     } else {
    //         Session::flash('error', 'Leave application not found.');
    //     }
    //     return redirect()->route('leave_applications.show');
    // }

    public function approve(Request $request, $leave_applications_id)
    {
        $leaveApplication = leave_applications::find($leave_applications_id);
        if ($leaveApplication) {
            $leaveApplication->status = "อนุมัติ";
            $leaveApplication->cause = $request->input('cause'); // รับค่าคำอธิบายการอนุมัติจากฟอร์ม
            $leaveApplication->save();
            Session::flash('success', 'Leave application approved successfully!');
        } else {
            Session::flash('error', 'Leave application not found.');
        }
        return redirect()->route('leave_applications.show');
    }

    public function decline(Request $request, $leave_applications_id)
    {
        $leaveApplication = leave_applications::find($leave_applications_id);
        if ($leaveApplication) {
            $leaveApplication->status = "ปฏิเสธ";
            $leaveApplication->cause = $request->input('cause'); // รับค่าคำอธิบายการอนุมัติจากฟอร์ม
            $leaveApplication->save();
            Session::flash('success', 'Leave application approved successfully!');
        } else {
            Session::flash('error', 'Leave application not found.');
        }
        return redirect()->route('leave_applications.show');
    }

    

    public function create()
    {


        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
              $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }



        $userId = session('loginUser');  // Assuming you store the user_id in the session as 'loginUser'
        $employee = Employees::where('user_id', $userId)->first();
        $jobDetail = Job_details::where('emp_id', $employee->emp_id)->first();

        return view('leave_application', compact('employee', 'jobDetail','data'));
    }

    public function store(Request $request)
    {
        // Fetch emp_id of the currently logged-in user
        $empId = Employees::where('user_id', session('loginUser'))->first()->emp_id;

        // Validation
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'reason' => 'required|string',
            'pdf_path' => 'nullable|mimes:pdf|max:2048'
        ]);

        // Check and store pdf if uploaded
        $pdfPath = null;
        if ($request->hasFile('pdf_path')) {
         $pdfPath = $request->file('pdf_path')->store('public/leave_pdfs');
}


        // Create a new leave application record
        $leaveApplication = new leave_applications();
        $leaveApplication->from_date = $request->from_date;
        $leaveApplication->to_date = $request->to_date;
        $leaveApplication->reason = $request->reason;
        $leaveApplication->emp_id = $empId;
        $leaveApplication->pdf_path = $pdfPath;
        $leaveApplication->save();

        return redirect()->back()->with('success', 'Leave Application Submitted Successfully!');
    }
    public function download($id) {
        $leaveApplication = leave_applications::findOrFail($id);

        if ($leaveApplication->pdf_path) {
            return response()->download(storage_path("app/{$leaveApplication->pdf_path}"));
        }

        return redirect()->back()->with('error', 'No file found for this application.');
    }

}

