<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Library\queryTableUser;


class CheckRoleCensor
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

        if ($this->role() == "Censor"){
            return redirect()->back();
        }
        return $next($request);
    }
}
