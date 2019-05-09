<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Support\Facades\Auth;

class CheckRoleEditor
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
        $user_id = Auth::user()->id;
        $role = DB::table('users')->select('role')->where('id', $user_id)->first();
        if ($role->role == "1"){
            return redirect()->back();
        }
        return $next($request);
    }
}
