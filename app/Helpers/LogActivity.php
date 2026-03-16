<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class LogActivity
{
    public static function log_activity($activity)
    {
        // Cek header X-Forwarded-For
        $ip = Request::header('X-Forwarded-For');
        
        if ($ip) {
            $ips = explode(',', $ip);
            $originalIp = trim($ips[0]);
        } else {
            $originalIp = Request::ip();
        }

        $username = Auth::check() ? Auth::user()->email: null; 

        DB::table('activity_log')->insert([
            'ip' => $originalIp,
            'log_activity' => $activity,
            'username' => $username, 
        ]);
    }
}