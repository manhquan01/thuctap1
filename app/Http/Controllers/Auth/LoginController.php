<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/uae';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        $email = User::select('email')->where($this->username(), $request->only($this->username()))->count();
        if ($email > 0) {
            $activated = User::select('activated')
                ->where($this->username(), $request->only($this->username()))
                ->get()
                ->toArray();
            if ($activated[0]['activated'] == '1') {
                return $this->guard()->attempt(
                    $this->credentials($request), $request->filled('remember')
                );
            } else {
                throw ValidationException::withMessages([
                    $this->username() => 'Account has not been activated yet',
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                $this->username() => 'These credentials do not match our records.',
            ]);
        }


    }
}
