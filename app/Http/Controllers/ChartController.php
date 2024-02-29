<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job_details;

class ChartController extends Controller
{
    public function showDepartmentChart()
    {
        $departments = Job_details::select('department', \DB::raw('count(*) as total'))
                                  ->groupBy('department')
                                  ->get();

        return view('department_chart', compact('departments'));
    }

}

