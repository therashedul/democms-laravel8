<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Loginhistory;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class LoginhistoryController extends Controller
{
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
    public function index()
    {
        $userID = Auth::id();
        $Ip      = $this->getIp();
        $loginHistory =  new Loginhistory ([ 
                'user_id'=> $userID,
                'ip' => $Ip,
            ]);
			$loginHistory->save();
            return $loginHistory;
    }
    public function userId(){
        $userID = Auth::id();
        return $userID;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function show(Loginhistory $loginhistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function edit(Loginhistory $loginhistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loginhistory $loginhistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loginhistory  $loginhistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loginhistory $loginhistory)
    {
        //
    }
}
