<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Validator;
use Illuminate\Support\Facades\Auth;


class ApiController extends Controller
{
    public function createUser (Request $request){

      if($request->isMethod('post')){
            $data = $request->all();
                $roles = [
                                'name'=>'required',
                                'email'=>'required|email|unique:users',
                                'password'=>'required',
                            ];
                $customMessages = [
                                'name.required'=>'Name is required',
                                'email.required'=>'Email is required',
                            ];
                $validetor = Validator::make($data, $roles, $customMessages);

                            if($validetor->fails()){
                                return \response()->json($validetor->errors(), 422);  // 422 user for error code
                            }

                            // return $data;
                            $user = new User();
                            $user->name = $data['name'];
                            $user->email = $data['email'];
                            $user->password = bcrypt($data['password']);
                            $user->save();
                            if(Auth::attempt(['email'=> $data['email'], 'password'=> $data['password']])){
                                
                                $user  = User::where('email', $data['email'])->first();
                                $access_token = $user->createToken($data['email'])->accessToken;

                                User::where('email', $data['email'])->update(['access_token' => $access_token]);
                                $massage = 'user register successfully';
                                return \response()->json(['massage', $massage,'access_token', $access_token], 201); // 201 for date insert code
                            }else{
                                $massage = 'Opps! something wrong';
                                return \response()->json(['massage', $massage], 422); 
                            }

                    //    $name = $request->name;
                    //    return $name;
                
                    //    $user = User::first();
                    //    $token = $user->createToken('Token Name')->accessToken;
                    //    return $token;
                }
   }

    public function userlogin(Request $request){
          if($request->isMethod('post')){
            $data = $request->all();
            $roles = [
                'email'=>'required|email|exists:users',
                'password'=>'required',
            ];
            $customMessages = [
                'email.required'=>'Email is required',
                'email.email'=>'Email must be valied',
                'email.exists'=>'Email does not exists',
            ];
            $validetor = Validator::make($data, $roles, $customMessages);

            if($validetor->fails()){
                return \response()->json($validetor->errors(), 422);  // 422 user for error code
            }
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                $user  = User::where('email', $data['email'])->first();

                $access_token = $user->createToken($data['email'])->accessToken;
                User::where('email', $data['email'])->update(['access_token' => $access_token]);
                $massage = 'user login successfully';
                return \response()->json(['massage', $massage,'access_token', $access_token], 200); // 201 for date insert code
            }else{
                 $massage = 'Opps! something wrong';
                return \response()->json(['massage', $massage], 422); 
            }

        }

    }
}
