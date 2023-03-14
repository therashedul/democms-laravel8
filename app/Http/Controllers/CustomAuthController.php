<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;
use Session;
use App\Models\User;
use App\Models\Hitlog;
use App\Models\Loginhistory;
use Illuminate\Support\Arr;
use Validator;
use App\Models\UserVerify;
use Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HitlogController;
use App\Http\Controllers\LoginhistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyAdmin;

class CustomAuthController extends Controller

{
    
    function __construct()
    {

        $Hitlog  = new HitlogController;   
        $Hitlog->sitehit();
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {     
    
        return view('auth.login');
    }  
    
    public function customHome(){
        return view('home');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.register');
    }      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function customLogin(Request $request)    {
     // dd("dkk");
        $status = '';
        $userID = '';
        $dbip='';
        $blIp = '';
        $clintIp = new LoginhistoryController;
        $clIp =$clintIp->getIp();
        if($request->isMethod('post')){
        $remember_me = $request->has('remember') ? true : false; // get remember value
        $credentials = $request->only('email', 'password');   
        $users = DB::table('users')
                    ->select('*')
                    ->where([
                        ['email','=',$request->input('email')],
                        ['is_email_verified','=','1'],
                    ])
                    ->get();
                    // print_r($users);
                    // die();
            foreach($users as $user){
                    $userID =  $user->id;
                    $status =  $user->status_id;                   
            $white = DB::table('whitelists')
                    ->select('*')
                    ->where('user_id', $user->id)  
                    ->get();    
            $black = DB::table('blacklists')->select('*')->get();

            foreach($black as $bvalue){
                $blIp = $bvalue->ip;
                if(($blIp == $clIp) || ($bvalue->user_id == $user->id)){
                    $LoginData =  new Loginhistory ([ 
                    'ip' => $blIp,  
                    'user_id' => $user->id,
                    'reason'=> "IP or ID Black Listed",
                ]);
                $LoginData->save(); 
                return redirect("login")->with('error','Oppes! Your IP or User Black Listed');
                }else{
                        foreach($white as $value){
                            $dbip=$value->ip;
                            if((($userID == $value->user_id) && ($clIp==$dbip)) || ($dbip == '0.0.0.0')){
                                    $LoginData =  new Loginhistory ([ 
                                        'ip' => $value->ip,
                                        'user_id'=> $value->user_id,
                                        'reason'=>'Ipwhitelisted',
                                    ]);
                                    $LoginData->save(); 
                                }
                            elseif((($userID == $value->user_id) && ($clIp != $dbip)) || ($dbip == '0.0.0.0')){
                                    $LoginData =  new Loginhistory ([ 
                                        'ip' => $clIp,
                                        'user_id'=> $value->user_id,
                                        'reason'=>'Ip_not_white_listed',
                                    ]);
                                    $LoginData->save(); 
                                    return redirect("login")->with('error','Oppes! Your IP is not WhiteListed');
                                }
                            else{
                                    $LoginData =  new Loginhistory ([ 
                                        'ip' => $clIp,
                                        'reason'=>"Add user Id",
                                    ]);                           
                                    $LoginData->save(); 
                                    return redirect("login")->with('error','Oppes! Add Your User ID'); 
                                }
                            // End If state ment
                            if(($clIp==$dbip) || ($dbip == '0.0.0.0')){                           
                                        $request->validate([
                                            'email' => 'required|string',
                                            'password' => 'required|string',
                                            //'g-recaptcha-response' => 'required|captcha',
                                            ]);
                                            // ================= Start remember 
                                            if($request->remember===null){
                                                    setcookie('login_email',$request->email,100);
                                                    setcookie('login_pass',$request->password,100);
                                            }
                                            else{
                                                    setcookie('login_email',$request->email,time()+60*60*24*120);
                                                    setcookie('login_pass',$request->password,time()+60*60*24*120);
                                            }
                                            //  End remember
                                                    if($status==1){
                                                        if($user->role_id == 1){
                                                            if (Auth::attempt($credentials, $remember_me)) {  
                                                                $user  = User::where('email', $request->email)->first();
                                                                $access_token = $user->createToken($request->email)->accessToken;
                                                                User::where('email', $request->email)->update(['access_token' => $access_token]);
                                                                Session::put('user_session', $request->email);
                                                                Session::put('pass_session', $request->password);                           
                                                                return redirect()->intended(route('home'))
                                                                ->withSuccess('Signed in');
                                                            }
                                                            else{
                                                                Loginhistory::create([
                                                                            'ip' => $clIp,
                                                                            'user_id'=> $value->user_id,
                                                                            'reason'=>'invalid credentials',
                                                                        ]); 
                                                                return redirect("login")->with('error','Oppes! You have entered invalid credentials');
                                                            }
                                                        }elseif($user->role_id == 2){
                                                            if (Auth::attempt($credentials,  $remember_me)) {
                                                                $user  = User::where('email', $request->email)->first();
                                                                $access_token = $user->createToken($request->email)->accessToken;
                                                                User::where('email', $request->email)->update(['access_token' => $access_token]);
                                                                Session::put('user_session', $request->email);
                                                                Session::put('pass_session', $request->password);
                                                                return redirect()->intended(route('home'))
                                                                ->withSuccess('Signed in');
                                                                
                                                            }
                                                            else{
                                                                 Loginhistory::create([
                                                                            'ip' => $clIp,
                                                                            'user_id'=> $value->user_id,
                                                                            'reason'=>'invalid credentials',
                                                                        ]); 
                                                                return redirect("login")->with('error','Oppes! You have entered invalid credentials');
                                                            }
                                                        }
                                                        elseif($user->role_id == 3){
                                                            if (Auth::attempt($credentials, $remember_me)) {
                                                                $user  = User::where('email', $request->email)->first();
                                                                $access_token = $user->createToken($request->email)->accessToken;
                                                                User::where('email', $request->email)->update(['access_token' => $access_token]);
                                                                Session::put('user_session', $request->email);
                                                                Session::put('pass_session', $request->password);
                                                               return redirect()->intended(route('home'))
                                                                ->withSuccess('Signed in');
                                                            }
                                                            else{
                                                                 Loginhistory::create([
                                                                            'ip' => $clIp,
                                                                            'user_id'=> $value->user_id,
                                                                            'reason'=>'invalid credentials',
                                                                        ]); 
                                                                return redirect("login")->with('error','Oppes! User You have entered invalid credentials');
                                                            }                                
                                                        }
                                                        else{
                                                            return redirect("login")->with('error','Your Role ID is not match');
                                                        }
                                                    }else{
                                                        return redirect("login")->with('error', 'Your account is suspended, or account inactive, please contact Admin.');
                                                    }
                                                    // End if  status 
                                    }
                                    // END if
                            } 
                            // End if $clIp==$dbip
                        }
                    // End white foreach  list          
                    return redirect("login")->with('error','Please do white listed contact your admin');         
                }
                // End if statment            
            } 
            Loginhistory::create([
                    'ip' => $clIp,
                    'user_id'=> '0',
                    'reason'=>'invalid credentials',
                ]);
            return redirect("login")->with('error','Oppes! You have entered invalid credentials');            
        }
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
           
        $data = $request->all();
        $createUser = $this->create($data);
  
        $token = Str::random(64);
        $id = $createUser->id;
        $email = $createUser->email;
      
        UserVerify::create([
            'user_id' => $createUser->id, 
            'token' => $token
        ]);
        $user['to']= $request->email;
            Mail::send('email.emailVerificationEmail', ["token" => $token],  function($message) use($user){
                $message->to( $user['to']);
                $message->subject('Email Verification Mail');
            });

            $admin = User::find(1);
            Notification::send($admin, new NotifyAdmin($createUser));

   

        return view('verify', compact('id','email'));
         
        // return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
        
    }

    public function verificationResend($id){   
        $user = User::where('id',$id)->first();
        $token = Str::random(64);
             UserVerify::create([
              'user_id' => $user->id, 
              'token' => $token
            ]);
            $email = $user->email;
            $userto['to']= $user->email;
        if ($user->is_email_verified == ''){
                Mail::send('email.emailVerificationEmail', ["token" => $token],  function($message) use($userto){
                $message->to( $userto['to']);
                $message->subject('Email Verification Mail');
            });
            $message = ('We just sent you the verification link at your email ('.$user->email.') again, please check it.');
            return view('verify', compact('id','email','message'));
        }
        else {
            return redirect('/')->with(array('error' => 'Your Email is already active, please contact us at info@127.0.0.1 if you have any problem.'));
        }
        // Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
        //       $message->to($request->email);
        //       $message->subject('Email Verification Mail');
        //   });
        // return view('verify');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('home');
        }  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'role_id' => '3',
        'status_id' =>'1',
      ]);
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function signOut() {
        Session::flush();
        Auth::logout();  
        return Redirect('home');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();  
        $message = 'Sorry your email cannot be identified.';  
             if(!is_null($verifyUser) ){
                   $userId = $verifyUser->user_id; 
                   $user = DB::table('users')->where('id','=',$userId )->first();
                   
                  if(empty($user->is_email_verified)) {
                    //   print_r($user);
                    $verifyUser->user->is_email_verified = 1;
                    $verifyUser->user->save();
                    $message = "Your e-mail is verified. You can now login.";
                } else {
                    $message = "Your e-mail is already verified. You can now login.";
                  
                  }
           
         }
   
   
        return redirect("login")->with('success', $message);
    }
}