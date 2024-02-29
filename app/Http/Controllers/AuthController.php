<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;
use App\Models\User;
use App\Models\Employees;
use Illuminate\Support\Facades\Log;
use App\Models\leave_applications;
use App\Models\Job_details;
use Illuminate\Support\Facades\Http;
use jcobhams\NewsApi\NewsApi;




class AuthController extends Controller
{
    //
    public function registration()
    {
        return view('auth.registration');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        DB::beginTransaction();
        try {
            // Create a user record.
            $user = new User();
            $user->user_id = $request->user_id;
            $user->role = $request->role;
            $user->email = $request->email;
            $user->password = $request->password; // Hash the password

            if (!$user->save()) {
                throw new \Exception('Failed to save user.');
            }

            Log::info('User saved successfully with ID: ' . $user->user_id);

            DB::commit();
            return back()->with('succuess', 'You have registered successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Registration error: ' . $e->getMessage());
            Log::info('Form Data:', $request->all());
            return back()->with('fail', 'Registration failed. Please try again.');
        }
    }


    //login
    public function login(){
        return view('auth.login');
    }
    //check
    public function loginUser(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $user = User::where('email','=',$request->email)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                $request->session()->put('loginUser',$user->user_id);

                // Check the user's role to redirect
                if($user->role == 'employee'){
                    return redirect('index'); // or whatever your employee dashboard route is
                } elseif ($user->role == 'admin') {
                    return redirect('dashboard'); // or whatever your admin dashboard route is
                } else {
                    return redirect('dashboard'); // default dashboard if no specific role matches
                }

            }else{
                return back()->with('fail','Password not match.');
            }
        }else{
            return back()->with('fail','Email not registration.');
        }
    }



    ////Admin dashboard
    public function dashboard() {
        $data = [];
        $user_id = Session::get('loginUser');
        $userExists = User::find($user_id);

        if (!$userExists) {

                return $this->logout();
            }


        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');

            // Validate the user_id from the session



            $data = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.user_id')
            ->where('users.user_id', $user_id)
            ->select('users.*', 'employees.*')
            ->first();

            // Checking if this user already has an employee record
            $existingEmployees = Employees::where('user_id', $user_id)->first();

            if (!$existingEmployees) {
                // If not, create a new employee record
                $newEmployee = new Employees();

                // Generate a unique emp_id
                $latestEmployee = Employees::orderBy('emp_id', 'desc')->first();
                $latestEmpId = $latestEmployee ? intval(substr($latestEmployee->emp_id, 3)) : 0;
                $newEmpId = 'EMP' . str_pad($latestEmpId + 1, 3, '0', STR_PAD_LEFT);

                $newEmployee->emp_id = $newEmpId;
                $newEmployee->user_id = $user_id;
                // Add other necessary fields here...
                $newEmployee->save();
            }

        }
        $approvedCount = leave_applications::where('status', 'อนุมัติ')->count();
        $refuseCount = leave_applications::where('status', 'ปฏิเสธ')->count();
        $AllCount = leave_applications::count();
        $employeeCount = User::where('role', 'employee')->count();
        $departments = Job_details::select('department', \DB::raw('count(*) as total'))
                                  ->groupBy('department')
                                  ->get();
        return view('dashboard', compact('data', 'employeeCount','approvedCount','refuseCount','AllCount','departments'));
    }



    //logout
    public function logout()
    {
        if(Session::has('loginUser')){
            Session::pull('loginUser');
            return redirect('registration');
        }
    }

    public function index() {
        if (Session::has('loginUser')) {
            $user_id = Session::get('loginUser');
    
            // Validate the user_id from the session
    
            $data = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.user_id')
                ->where('users.user_id', $user_id)
                ->select('users.*', 'employees.*')
                ->first();
    
            $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&apiKey=c435a90d306a4ab88ea076038a838d0e");
        
            if ($response->successful()) {
                $articles = $response->json()['articles']; // ดึงข้อมูล articles จาก response
    
                // ส่งข้อมูล data และ articles ไปยังหน้า View ด้วยคำสั่ง compact
                return view('index', compact('data', 'articles')); 
            } else {
                return back()->with('error', 'Failed to fetch news data.');
            }
        }
        return view('index'); // ในกรณีที่ไม่มี session 'loginUser' หรือไม่ผ่านการตรวจสอบ user_id
    }

    // // API
    // public function fetchData()
    // {
    //     //$key = 'c435a90d306a4ab88ea076038a838d0e'; // แทนที่ YOUR_NEWS_API_KEY ด้วย API key ของคุณ
    //     $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=c435a90d306a4ab88ea076038a838d0e");
    //     $data = $response->json();

    //     return view('index', ['data' => $data->articles ?? null]);
    // }

    public function test() 
    {
        // //GET https://newsapi.org/v2/top-headlines?country=us&apiKey=API_KEY    
        // $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&apiKey=c435a90d306a4ab88ea076038a838d0e");
        // // $response = Http::get('https://newsapi.org/v2/top-headlines?country=us&
        // // apiKey='.getenv('NEWS_API_KEY'));
        // // dd($response);
        // if ($response->successful()) {
        //     $articles = $response->json()['articles']; // ดึงข้อมูล articles จาก response
        //     foreach ($articles as $article) {
        //         echo $article['title'] . "<br/>";
        //     }
        // } else {
        //     echo "ไม่สามารถดึงข้อมูลได้";
        // }

        $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&apiKey=c435a90d306a4ab88ea076038a838d0e");
    
        if ($response->successful()) {
            $articles = $response->json()['articles']; // ดึงข้อมูล articles จาก response
            
            return view('index', ['articles' => $articles]); // ส่งข้อมูล articles ไปยังหน้า View
        } else {
            return back()->with('error', 'Failed to fetch news data.');
        }
    }
}
