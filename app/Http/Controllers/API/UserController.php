<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 


class UserController extends Controller
{
    public $successStatus = 200;

    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

     public function login()
     {
         if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
             $user = Auth::user();
             $success['token'] = $user->createToken('backend')->accessToken;
             return response()->json(['success' => $success], $this->successStatus);
         } else {
             return response()->json(['message' => 'Login failed', 401]);
         }
         
     }

     /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

     public function register(Request $request)
     {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|min:8',
        ]);
        
    
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        
        $success['token'] =  $user->createToken('backend')->accessToken; 
        $success['name'] =  $user->name;
        return response()->json(['message' => 'Success'], $this->successStatus);
        
     }
    
}
