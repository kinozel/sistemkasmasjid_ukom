<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function index(){

        return view("auth.index");
    } 

    public function login(Request $request){
    
        $credetials = [
            "username"=> $request->username,
            "password"=> $request->password,

        ];

        if(Auth::attempt($credetials)){
            return redirect('/dashboard')->with('success','login berhasil');
        }

        return back()->with('error','username or password salah');

    }

    public function logout(){
    Auth::logout();
    return redirect('/auth')->with('success','logout berhasil');
    }
}
