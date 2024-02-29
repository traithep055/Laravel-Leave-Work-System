<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;  // Make sure you've created this model
use Illuminate\Support\Facades\Session;
use DB;
class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employees::all();
        $searchedEmployee = null;  // Initialize as null

        if ($request->has('search_id')) {
            $searchedEmployee = Employees::where('emp_id', $request->search_id)->first();
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

        return view('employee_edit', compact('employees', 'searchedEmployee' , 'data'));
    }



    public function create()
    {
        return view('employee_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|unique:employees,emp_id',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'dob' => 'nullable|date',
            'contact_number' => 'nullable|string',
            'address' => 'nullable|string',
            'user_id' => 'required|string|exists:users,user_id'
        ]);

        $employee = new Employees;
        $employee->fill($request->all());
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Employee added successfully!');
    }

    public function edit($emp_id)
    {
        $employeeToEdit = Employees::findOrFail($emp_id);  // Fetch the employee you want to edit
        $employees = Employees::all();  // Fetch all employees for the table

        return view('employee_edit', compact('employeeToEdit', 'employees'));  // Return the view with the employee to edit and all employees
    }


    public function update(Request $request, $emp_id)
    {
        $employee = Employees::findOrFail($emp_id);

        $request->validate([
            'emp_id' => 'required|unique:employees,emp_id,' . $employee->emp_id . ',emp_id',
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'dob' => 'nullable|date',
            'contact_number' => 'nullable|string',
            'address' => 'nullable|string',
            'user_id' => 'required|string|exists:users,user_id'
        ]);

        $employee->fill($request->all());
        $employee->save();

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully!');
    }

    public function destroy($emp_id)
    {
        Employees::findOrFail($emp_id)->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully!');
    }

}

