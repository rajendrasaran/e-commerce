<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    public function login()
    {
        return view('login/login');
    }
    public function register()
    {
        return view('login/register');
    }
    public function rejisteruser(Request $request)
    {
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
    

    public function loginuser(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($loginData)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Get the authenticated user
        $user = Auth::user();

        // Generate API Token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Check if it's an API request
        if ($request->expectsJson()) {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        }

        // If request is from a browser, redirect to dashboard
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
