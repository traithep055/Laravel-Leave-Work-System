<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leave_applications;

class LeaveAppController extends Controller
{
    public function index()
    {
        $leaveApplications = leave_applications::all();
        return view('leaveapp.index', compact('leaveApplications'));
    }


    public function edit($leave_applications_id)
    {
        $leaveApplication = leave_applications::findOrFail($leave_applications_id);
        return view('leaveapp.edit', compact('leaveApplication'));
    }

    public function update(Request $request, $leave_applications_id)
    {
        $leaveApplication = leave_applications::findOrFail($leave_applications_id);

        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'reason' => 'required|string',
            'status' => 'required|string',
            'emp_id' => 'required|exists:employees,emp_id',
            'pdf_path' => 'nullable|file'
        ]);

        $data = $request->all();

        if($request->hasFile('pdf_path')) {
            $path = $request->file('pdf_path')->store('pdfs');
            $data['pdf_path'] = $path;
        }

        $leaveApplication->update($data);
        return redirect()->route('leaveapp.index')->with('success', 'Leave application updated successfully!');
    }

    public function destroy($leave_applications_id)
    {
        $leaveApplication = leave_applications::findOrFail($leave_applications_id);
        $leaveApplication->delete();
        return redirect()->route('leaveapp.index')->with('success', 'Leave application deleted successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'reason' => 'required|string',
            'status' => 'required|string',
            'emp_id' => 'required|exists:employees,emp_id',
            'pdf_path' => 'nullable|file'
        ]);

        $data = $request->all();

        if($request->hasFile('pdf_path')) {
            $path = $request->file('pdf_path')->store('pdfs');
            $data['pdf_path'] = $path;
        }

        leave_applications::create($data);
        return redirect()->route('leaveapp.index')->with('success', 'Leave application created successfully!');
    }
}
