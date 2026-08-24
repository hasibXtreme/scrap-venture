<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
class AuthController extends Controller
{
    public function loginpage()
    {
        return View('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                if(Auth::user()->is_admin)
                    {
                        return redirect()->intended(route('admin.collectors.index'));
                    }

                    Auth::logout();
                    return back()->withErrors(['email'=>'Acess denied']);
            }

            return back()->withErrors(['email'=>'Provided crdentials do not match']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
