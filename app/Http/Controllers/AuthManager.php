<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login(){
        return view('login');
    }

    function registration(){
        return view('registration');
    }

    function home(){
        return view('home');
    }

    function main(){
        return view('main');
    }

    function karcis(){
        return view('karcis');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error", "Registration failed, ty again");
        }
        return redirect(route('login'))->with("success", "Registration success, Login to the app");

    }

    function mainPost(Request $request){
        $request->validate([
            'slot_parkir' => 'required',
        ]);

        $credentials = $request->only('slot_parkir');
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('karcis'));
        }
    }

    function logout(){
        session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
