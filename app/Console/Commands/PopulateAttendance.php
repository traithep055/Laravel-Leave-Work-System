<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employees;
use App\Models\leave_applications;
use App\Models\Attendance;
use Carbon\Carbon;

class PopulateAttendance extends Command

{
    protected $signature = 'attendance:populate';
    protected $description = 'Populate the attendances table based on leave applications';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now()->toDateString();

        $employees = Employees::all();

        foreach ($employees as $employee) {
            $leave = leave_applications::where('emp_id', $employee->emp_id)
                       ->where('from_date', '<=', $today)
                       ->where('to_date', '>=', $today)
                       ->where('status', 'อนุมัติ')  // Check if the leave was approved
                       ->first();

            $attendance = new Attendance();
            $attendance->date = $today;
            $attendance->emp_id = $employee->emp_id;
            $attendance->status = $leave ? 'On-Leave' : 'Present';
            $attendance->save();
        }

        $this->info('Attendance populated for ' . $today);
    }


}
