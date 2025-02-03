<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('login/login');
    
    }
    public function register() {
        return view('login/register');
    
    }
    public function rejisteruser(Request $request) {
        // $userData = [
        //     "Name" =>$request->input('name'),
        //     "email" =>$request->input('email'),
        //     // "password" =>$request->input('password'),
        //      "password" => Hash::make($request->input('password'))
            
        // ];
        // dd($userData);
        User::create($request->all());
        
        return redirect()->route('login');

    }
    public function loginuser(Request $request){
        $loginData = $request->only('email', 'password');
        
     
        if (Auth::attempt($loginData)){
           
            return redirect()->route('dashboard');
        } else{
            return redirect()->route('login');
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
}
