<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class AllSystemController extends Controller
{
    public function index()
    {
        $data = null;
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            // Validate the user_id from the session



            $data = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.user_id')
            ->where('users.user_id', $user_id)
            ->select('users.*', 'employees.*')
            ->first();
    }
        return view('all-system', compact('data'));
    }
}

