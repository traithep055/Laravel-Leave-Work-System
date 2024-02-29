<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobDetailsController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\AttendaceController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\UserEditController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AllSystemController;
use App\Http\Controllers\JobDetailEditController;
use App\Http\Controllers\LeaveAppController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\YourController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\generatePDF;
use App\Http\Controllers\CausecheckController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Registration
Route::get('registration', [AuthController::class, 'registration'])->middleware('nowLogin');
Route::post('registration-user', [AuthController::class, 'registerUser'])->name('registration.user');

// Login
Route::get('login', [AuthController::class, 'login'])->middleware('nowLogin');
Route::post('login-user', [AuthController::class, 'loginUser'])->name('login.user');

// Dashboard
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware(['checklogin','check.role','check.access:admin']);
Route::view('Access-denied', 'Access-denied');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/index', [AuthController::class, 'index'])->name('index')->middleware(['checklogin','check.role']);
// Route::get('/test', [AuthController::class, 'test'])->name('test')->middleware(['checklogin','check.role']);
// Route::get('/index', [AuthController::class, 'fetchData'])->name('fetch.data')->middleware(['checklogin','check.role']);

// Route::get('/test', [AuthController::class, 'test'])->name('test')->middleware(['checklogin','check.role']);






Route::middleware(['check.role'])->group(function () {

    Route::get('/generate-pdf', [generatePDF::class,'generatePDF'])->name('generate-pdf');
    Route::get('/generate-pdf2', [generatePDF::class,'generatePDF2'])->name('generate-pdf2');
    Route::get('/generate-pdf3', [generatePDF::class,'generatePDF3'])->name('generate-pdf3');
    Route::get('/department-chart', [ChartController::class, 'showDepartmentChart']);

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::post('/profile-update', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('/add-job-details', [JobDetailsController::class, 'create'])->middleware(['check.access:admin']);;
    Route::post('/add-job-details', [JobDetailsController::class, 'store'])->middleware(['check.access:admin'])->name('add.job.details');

    Route::get('/attendance', [AttendaceController::class, 'show'])->name('attendance.show')->middleware(['check.access:admin']);

    Route::get('/empdata', [EmpController::class, 'show'])->name('empdata.show');

    Route::get('/leave-application', [LeaveApplicationController::class, 'create'])->name('leave_applications.create');
    Route::post('/leave-application', [LeaveApplicationController::class, 'store'])->name('leave_applications.store');

    Route::get('/leave-application-show', [LeaveApplicationController::class, 'show'])->name('leave_applications.show')->middleware(['check.access:admin']);
    Route::get('/leave-application/{leave_applications_id}', [LeaveApplicationController::class, 'view'])->name('leave_applications.view')->middleware(['check.access:admin']);
    Route::put('/leave-application-approve/{leave_applications_id}', [LeaveApplicationController::class, 'approve'])->name('leave_applications.approve')->middleware(['check.access:admin']);
    Route::put('/leave-application-decline/{leave_applications_id}', [LeaveApplicationController::class, 'decline'])->name('leave_applications.decline')->middleware(['check.access:admin']);
    Route::get('/leave-applications/download/{id}', [LeaveApplicationController::class, 'download'])->name('leaveApplications.download')->middleware(['check.access:admin']);


    Route::get('/users', [UserEditController::class, 'index'])->name('user.index')->middleware(['check.access:admin']);
    Route::get('/user/edit/{user_id}', [UserEditController::class, 'edit'])->name('user.edit')->middleware(['check.access:admin']);
    Route::put('/user/update/{user_id}', [UserEditController::class, 'update'])->name('user.update')->middleware(['check.access:admin']);
    Route::delete('/user/{user_id}', [UserEditController::class, 'destroy'])->name('user.destroy')->middleware(['check.access:admin']);
    Route::post('/user/store', [UserEditController::class, 'store'])->name('user.store')->middleware(['check.access:admin']);


    Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index')->middleware(['check.access:admin']);
    Route::get('/employee/edit/{emp_id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware(['check.access:admin']);
    Route::put('/employee/update/{emp_id}', [EmployeeController::class, 'update'])->name('employee.update')->middleware(['check.access:admin']);
    Route::delete('/employee/{emp_id}', [EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware(['check.access:admin']);
    Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store')->middleware(['check.access:admin']);


    Route::get('/all-system', [AllSystemController::class, 'index'])->name('all-system.index')->middleware(['check.access:admin']);

    Route::get('/jobdetails-edit', [JobDetailEditController::class, 'index'])->name('jobdetails-edit.index')->middleware(['check.access:admin']);
    Route::get('/jobdetails-edit/edit/{job_id}', [JobDetailEditController::class, 'edit'])->name('jobdetails-edit.edit')->middleware(['check.access:admin']);
    Route::put('/jobdetails-edit/update/{job_id}', [JobDetailEditController::class, 'update'])->name('jobdetails-edit.update')->middleware(['check.access:admin']);
    Route::delete('/jobdetails-edit/{job_id}', [JobDetailEditController::class, 'destroy'])->name('jobdetails-edit.destroy')->middleware(['check.access:admin']);
    Route::post('/jobdetails-edit/store', [JobDetailEditController::class, 'store'])->name('jobdetails-edit.store')->middleware(['check.access:admin']);





    Route::get('/leaveapp', [LeaveAppController::class, 'index'])->name('leaveapp.index')->middleware(['check.access:admin']);
    Route::get('/leaveapp/edit/{leave_applications_id}', [LeaveAppController::class, 'edit'])->name('leaveapp.edit')->middleware(['check.access:admin']);
    Route::put('/leaveapp/update/{leave_applications_id}', [LeaveAppController::class, 'update'])->name('leaveapp.update')->middleware(['check.access:admin']);
    Route::delete('/leaveapp/{leave_applications_id}', [LeaveAppController::class, 'destroy'])->name('leaveapp.destroy')->middleware(['check.access:admin']);
    Route::post('/leaveapp/store', [LeaveAppController::class, 'store'])->name('leaveapp.store')->middleware(['check.access:admin']);


    Route::get('/emp-leaves', [LeaveApplicationController::class, 'empLeaves'])->name('emp.leaves');

    Route::get('/adttendancereport', [ReportController::class, 'attendancereport'] )->name('adttendancereport.show');
    Route::get('/leaveworkreport', [ReportController::class, 'leaveworkreport'] )->name('leavereport.show')->middleware(['check.access:admin']);
    Route::get('/empreport', [ReportController::class, 'empreport'] )->name('empreport.show')->middleware(['check.access:admin']);
    Route::get('/run-command', [YourController::class, 'runArtisanCommand'])->middleware(['check.access:admin']);

    // API Show
    // Route::get('/fetch-data', [CausecheckController::class, '']);
});



