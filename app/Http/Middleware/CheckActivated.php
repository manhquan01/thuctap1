<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActivated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->activated == '1'){
            Auth::logout();
            $request->session()->flash('error', 'Your account has been blocked!');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
