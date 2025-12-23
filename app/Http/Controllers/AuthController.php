<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view("login", [
            "titlePage" => "Login"
        ]);
    }

    public function register(){
        return view("register", [
            "titlePage" => "Register"
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        User::create($request->all());
        return redirect()->route('login')->with('success', 'Registration Successful. Welcome!');
    }

    public function authenticate(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()->route('login')->withErrors(['loginFailed' => 'Email or password is incorrect.']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
