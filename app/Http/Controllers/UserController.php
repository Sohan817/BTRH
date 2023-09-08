<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //Validation
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // login code
        if (\Auth::attempt($request->only('email', 'password'),$request->remember)) {
            if($request->remember===null){
                setcookie('email',$request->email,100);
                setcookie('password',$request->password,100);
            }else{
                setcookie('email',$request->email,time()+60*60*24*100);
                setcookie('password',$request->password,time()+60*60*24*100);
            }
            return redirect('home');
        }
        return redirect('login')->withError('Login details are not valid');
    }
    public function register_view()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
        ]);
        // save in users table
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
        ]);
        // login user here

        if (\Auth::attempt($request->only('email', 'password'))) {
            return redirect('home');
        }
        // If error occurs
        return redirect('register')->withError('Error');
    }
    public function home()
    {
        return view('home');
    }
    //Logout User
    public function logout()
    {
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }
}
