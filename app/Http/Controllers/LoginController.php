<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('ujicoba.login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email:dns'],
            'password' => ['required'],
        ]);

        if(Auth::attemptWhen($credentials)){
            if(Auth::user()->level == "dosen"){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }else{
                $request->session()->regenerate();
                return redirect()->intended('/');

            }
        }

        return back()->with('loginError', 'Login Failed!');

        // dd('berhasil login!');
        
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
