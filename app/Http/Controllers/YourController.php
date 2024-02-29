<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Session;
use DB;
use Illuminate\Support\Facades\Cache;
class YourController extends Controller
{


    public function runArtisanCommand() {
        $today = now()->format('Y-m-d');

        // ตรวจสอบใน cache ว่ามีการรันคำสั่งวันนี้แล้วหรือยัง
        if (Cache::has('command_run_' . $today)) {
            return back()->with('fail' , 'you aleady run this command');
        }

        Artisan::call('attendance:populate');

        // ตั้งค่า cache สำหรับวันนี้ (คุณสามารถตั้งเวลาหมดอายุตามที่ต้องการ, ในที่นี้จะตั้งเป็น 24 ชั่วโมง)
        Cache::put('command_run_' . $today, true, now()->addDay());

        return back();
    }
}
