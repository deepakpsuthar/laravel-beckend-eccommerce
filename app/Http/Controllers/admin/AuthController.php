<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)){
            return redirect()->intended('admin/dashboard')
            ->withSuccess('Login Successfully');
        }
        return redirect()->route('admin.login')->with('error', 'Login details are not valid');
    }

    // public function register(){
    //     return view('admin.auth.register');
    // }

    // public function registerSubmit(Request $request){
    //     $credentials = $request->validate([
    //         'name' => ['required'],
    //         'email' => ['required', 'email'],
    //         'password' => ['required','min:6','confirmed'],
    //         'password_confirmation' => ['required'],
    //     ]);


    // }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
