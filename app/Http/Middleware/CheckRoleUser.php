<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Library\queryTableUser;


class CheckRoleUser
{
    use queryTableUser;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->role() == "User"){
            return redirect()->route('frontend_index');
        }
        return $next($request);
    }
}
