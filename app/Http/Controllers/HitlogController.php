<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Hitlog;
use App\Models\Blacklist;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class HitlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function device_browser( $browser = FALSE ) {
                $u_agent = $_SERVER['HTTP_USER_AGENT'];
                $bname = 'Unknown';
                $platform = 'Unknown';
                $version = "";

                if (preg_match('/linux/i', $u_agent)) {
                    $platform = 'linux';
                } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
                    $platform = 'mac';
                } elseif (preg_match('/windows|win32/i', $u_agent)) {
                    $platform = 'windows';
                }

                if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
                    $bname = 'Internet Explorer';
                    $ub = "MSIE";
                } elseif (preg_match('/Firefox/i', $u_agent)) {
                    $bname = 'Mozilla Firefox';
                    $ub = "Firefox";
                } elseif (preg_match('/Chrome/i', $u_agent)) {
                    $bname = 'Google Chrome';
                    $ub = "Chrome";
                } elseif (preg_match('/Safari/i', $u_agent)) {
                    $bname = 'Apple Safari';
                    $ub = "Safari";
                } elseif (preg_match('/Opera/i', $u_agent)) {
                    $bname = 'Opera';
                    $ub = "Opera";
                } elseif (preg_match('/Netscape/i', $u_agent)) {
                    $bname = 'Netscape';
                    $ub = "Netscape";
                }

                $known = array('Version', $ub, 'other');
                $pattern = '#(?<browser>' . join('|', $known) .
                        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
                if (!preg_match_all($pattern, $u_agent, $matches)) {

                }

                $i = count($matches['browser']);
                if ($i != 1) {
                    if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                        $version = $matches['version'][0];
                    } else {
                        $version = $matches['version'][1];
                    }
                } else {
                    $version = $matches['version'][0];
                }
                if ($version == null || $version == "") {
                    $version = "?";
                }

                if( $browser )
                {
                    return $bname.$version;
                }
                else
                {
                    return array(
                        'userAgent' => $u_agent,
                        'name' => $bname,
                        'version' => $version,
                        'platform' => $platform,
                        'pattern' => $pattern
                    );
                }     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIp(){        
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
         }
     return request()->ip(); // it will return server ip when no client ip found
    }

    public function index(Request $request)
    {   
        $this->timespent($request);
        return view('welcome');
    }
   public function timespent(Request $request){  
        $pageName =  \Route::current()->action['as'];
        $link  = $request->fullUrl();
        $HitLogData =  new Hitlog ([ 
                'ip' => $this->getIp(),
                'view'=> $pageName,
                'link'=> $link,
                'browser' => $this->device_browser($browser = TRUE),
                // 'spent_time' =>$time,
            ]);
            $HitLogData->save();   
        $blackId = DB::table('blacklists')->latest('id')->first();
        if($blackId == ''){
            $black =  new Blacklist ([ 
                'ip' => "::2"
            ]);
            $black->save();
        } 
        return array(
            'HitLogData' => $HitLogData,
            'blackId' => $blackId,
            // 'time' => $time
        );
        //  return response()->json($time);     
    }
    public function sitehit(){    
        $browser  = $this->device_browser($browser = TRUE);
        $Ip       = $this->getIp();
        $pageName =  \Route::current()->getName();
        $link = url()->current();
            $HitLogData =  new Hitlog ([ 
                    'ip' => $Ip,
                    'view'=> $pageName,
                    'link'=> $link,
                    'browser' => $browser,
                ]);
			$HitLogData->save();
            return $HitLogData;
     }

}