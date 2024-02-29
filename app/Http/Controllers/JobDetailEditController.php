<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job_details;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\Employees;
use Exception;


class JobDetailEditController extends Controller
{
    public function index(Request $request)
    {
        $job_details = Job_details::all();
        $searchedJob_details = null;

        if ($request->has('search_id')) {
            $searchedJob_details = Job_details::where('emp_id', $request->search_id)->first();
        }
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            // Validate the user_id from the session



            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
        }
        // Get all emp_ids from the job_details table.
        $usedEmpIds = Job_details::pluck('emp_id');

        // Fetch employees whose emp_id is not in the job_details table.
        $availableEmployees = Employees::whereNotIn('emp_id', $usedEmpIds)->get();

        return view('job_edit', compact('job_details', 'searchedJob_details', 'availableEmployees','data'));
    }





    public function create()
    {
        return view('employee_create');
    }

    public function store(Request $request)
{
    try {
        $request->validate([
            'emp_id' => 'required|exists:employees,emp_id',
            'department' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'salary' => 'required|numeric'
        ]);

        $jobDetails = new Job_details();
        $jobDetails->emp_id = $request->emp_id;
        $jobDetails->department = $request->department;
        $jobDetails->joining_date = $request->joining_date;
        $jobDetails->salary = $request->salary;
        $jobDetails->fill($request->all());
        $jobDetails->save();

        return redirect()->route('jobdetails-edit.index')->with('success', 'jobDetails added successfully!');
    } catch (\Exception $e) {
        // Logging the error message (optional but recommended)
        \Log::error("Error while saving job details: " . $e->getMessage());

        return redirect()->back()->withInput()->with('fail', 'Failed to add job details.');
    }
}


    public function edit($job_id)
    {
        $jobDetailsToEdit = Job_details::findOrFail($job_id);  // Fetch the job details you want to edit
        $job_details = Job_details::all();  // Fetch all job details for the table
        $existingJobEmployeeIds = Job_details::pluck('emp_id')->toArray();
        $availableEmployees = Employees::whereNotIn('emp_id', $existingJobEmployeeIds)->get();
        return view('job_edit', compact('jobDetailsToEdit', 'job_details','availableEmployees'));
        // Return the view with the job details to edit and all job details
    }



    public function update(Request $request, $job_id)
    {
        $jobDetails = Job_details::findOrFail($job_id);

        $request->validate([
            'emp_id' => 'required|exists:employees,emp_id',
            'department' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'salary' => 'required|numeric'
        ]);

        $jobDetails->fill($request->all());
        $jobDetails->save();

        return redirect()->route('jobdetails-edit.index')->with('success', 'jobDetails updated successfully!');
    }

    public function destroy($job_id)
    {
        Job_details::findOrFail($job_id)->delete();
        return redirect()->route('jobdetails-edit.index')->with('success', 'jobDetails deleted successfully!');
    }
}
