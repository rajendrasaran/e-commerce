<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;  
use App\Models\Quote;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function myaccount()
    {
        $auth = Auth::id();
        $user = User::where('id', $auth)->first(); 
        if(!Auth::user()) {
            return redirect()->route('registration');
        }
        return view('myAccount.myAccount', compact('user'));
    }


    public function login()  
    {
        return view('myAccount.login');
    }
    public function registration()
    {
        return view('myAccount.registration');
    }

    public function rejisteruser(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "email" => 'required',
            "password" => 'required',
        ]);

        $data = $request->all();
        $user = User::create([
            "name" => $data['name'],
            "email" => $data['email'],
            "type" => "customer",
            "password" => $data['password']

        ]);

        // Mail::to($data['email'])->send(new RegistrationMail($user));
    

        return redirect()->route('loginAdmin');
    }
    public function loginCustomer(Request $request)
    {
        $loginData = $request->only('email', 'password');
        $loginData['type'] = "customer";
        

        if (Auth::attempt($loginData)) {
            $cartId = session('cart_id');    
            session(['cart_id' => $cartId]);
            return redirect()->route('home');
        } else {
            return redirect()->route('loginAdmin');
            
        }
    }

    public function logout(Request $request)
    {
        $user = $request['type'] = 'customer';

        Auth::logout($user);

        $cartId = Str::random(20);
        session(['cart_id' => $cartId]);
        return redirect()->route('loginAdmin');
    }
   public function accountupdate(Request $request)
   {
    $name = $request->only('name');
    $userID = Auth::user()->id;
    User::where('id', $userID)->update($name);  
    

    return redirect()->back()->withSuccess('MyAccount Name Update SuccessFully.......');
   }


   public function newpassword(Request $request)
   {
     $request->validate([
        "password" => 'required',
        "new_password" => 'required',
        "confirm_password" => 'same:new_password'
     ]); 

       $userId = Auth::user()->id;
       $user = User::find($userId);
       $password = $request->input('password');
       $new_password = $request->input('new_password');
   
       if (Hash::check($password, $user->password)) {
           $user->password = $new_password;
           $user->update();
   
           return redirect()->back()->withSuccess('Password updated successfully');
       } else {
           return redirect()->back()->witherror('error');
       }
   }
}
