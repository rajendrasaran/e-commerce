<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

use Gate;

class NotForFrontUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()) {
            $userType = Auth::user()->type;
            if($userType=='customer') {
                
                abort_if(true, Response::HTTP_FORBIDDEN, 'Permission Denied! A customer is logged in. Please logout the current user and login as an admin.');
                //return redirect()->route('home');
            }
        }
        return $next($request);
    }
}
