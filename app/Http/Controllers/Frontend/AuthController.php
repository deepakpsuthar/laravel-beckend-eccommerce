<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('frontend.auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->intended('profile')
            ->withSuccess('Login Successfully');
        }
        return redirect("login")->with('error', 'Login details are not valid');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
