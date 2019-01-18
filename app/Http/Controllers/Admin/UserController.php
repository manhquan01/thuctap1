<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('Admin.Login_form.login');
    }

    public function postLogin(Request $request)
    {
        $data = ['email' => $request->email, 'password' => $request->password];
        if (Auth::attempt($data)) {
            return redirect()->route('index');
        }else{
            return back()->withInput()->with('error', 'Email or password is incorrect');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
