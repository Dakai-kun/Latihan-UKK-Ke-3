<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            return back()->with('error', 'You are already logged in!');
        }else{
            return view('auth.login');
        }
    }

    public function authenticate(Request $request){
        $authenticate = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
         
        if(Auth::attempt($authenticate)){
            return redirect()->intended('/dashboard')->with('success', 'You have successfully logged in!');
        }
            return back()->with('error', 'Username or password is incorrect!');
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', 'You have successfully logged out!');
    }
}
