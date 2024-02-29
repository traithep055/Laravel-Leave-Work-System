<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpController extends Controller
{
    public function show()
{
    if (!session()->has('loginUser')) {
        return redirect()->route('login');
    }

    $user_id = session('loginUser');
    $user = DB::table('users')->where('user_id', $user_id)->first();

    if (!$user) {
        // Consider redirecting with an error message instead of dying
        return redirect()->route('someRoute')->withErrors(['User not found!']);
    }

    $employee = DB::table('employees')->where('user_id', $user_id)->first();

    if (!$employee) {
        return redirect()->route('someRoute')->withErrors(['Employee details not found!']);
    }

    $jobDetails = DB::table('job_details')->where('emp_id', $employee->emp_id)->first();

    if (!$jobDetails) {
        // You can decide to either redirect with a message or just continue and handle the null case in the view
        $jobDetails = new \stdClass();
        $jobDetails->department = "N/A";
        $jobDetails->joining_date = "N/A";
        $jobDetails->salary = "N/A";
    }

    $data = (object) array_merge((array) $user, (array) $employee, (array) $jobDetails);

    return view('empdata', compact('data'));
}

}



