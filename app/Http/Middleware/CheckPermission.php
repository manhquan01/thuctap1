<?php

namespace App\Http\Middleware;
use App\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Closure;

class CheckPermission
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
        $name = Route::getCurrentRoute()->getName();
        $permissions = [];

        if (substr($name, 0, 5) == 'admin' && count(explode('.', $name)) > 2) {
            $action = Route::getCurrentRoute()->getAction();

            if (isset($action['role'])) {
                $role = $action['role'];
                $role = substr($role, 6, strlen($role));
                $oneDot = explode('.', $role);
                if (isset($oneDot[1])) {
                    if ($oneDot[1] == 'index' || $oneDot[1] == 'view' || $oneDot[1] == 'show')
                        $oneDot[1] = 'read';

                    if ($oneDot[1] == 'create' || $oneDot[1] == 'store')
                        $oneDot[1] = 'create';

                    if ($oneDot[1] == 'edit' || $oneDot[1] == 'update')
                        $oneDot[1] = 'update';

                    if ($oneDot[1] == 'delete' || $oneDot[1] == 'destroy')
                        $oneDot[1] = 'delete';

                    $oneDot = array_reverse($oneDot);
                    $permissions = implode('-', $oneDot);
                }
            } else {
                $name = substr($name, 6, strlen($name));
                $oneDot = explode('.', $name);
                if (isset($oneDot[1])) {
                    if ($oneDot[1] == 'index' || $oneDot[1] == 'view' || $oneDot[1] == 'show')
                        $oneDot[1] = 'read';

                    if ($oneDot[1] == 'create' || $oneDot[1] == 'store')
                        $oneDot[1] = 'create';

                    if ($oneDot[1] == 'edit' || $oneDot[1] == 'update')
                        $oneDot[1] = 'update';

                    if ($oneDot[1] == 'delete' || $oneDot[1] == 'destroy')
                        $oneDot[1] = 'delete';

                    $oneDot = array_reverse($oneDot);
                    $permissions = implode('-', $oneDot);
                }
            }
        }

        if (Auth::user()->can($permissions) == false) {
            return redirect()->route('frontend_index');
        }

        return $next($request);
    }
}
