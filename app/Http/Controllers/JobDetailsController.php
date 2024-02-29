<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Job_details;

class JobDetailsController extends Controller
{
    public function create()
    {
        $employees = Employees::all();
        return view('add_job_details', ['employees' => $employees]);
    }

    public function store(Request $request)
    {
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
        $jobDetails->save();

        return redirect('/add-job-details')->with('success', 'Job details added successfully!');
    }
}
