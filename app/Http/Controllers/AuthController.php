<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AuthController extends Controller
{

    public function register(){
        return view('auth.register');
    }
    public function handleRegister(Request $request){
        $request->validate([
            'name'=>'required|string|max:100',
            'email'=>'required|email|max:100',
            'password'=>'required|string|max:50|min:5'
        ]);
        
        $name=$request->name;
        $email=$request->email;
        $password=Hash::make($request->password);
        
        $user=User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
        ]);
        
        //login
        Auth::login($user);
        
        return view('auth.register');
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////
    public function login(){
        return view('auth.login');
        
    }
    public function handleLogin(Request $request){
        $request->validate([
            'email'=>'required|email|max:100',
            'password'=>'required|string|max:50|min:5'
        ]);
    
        $email=$request->email;
        $password=Hash::make($request->password);
        //attempt return true or false
        $is_login= Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);
        //if flase
        if(! $is_login){
            // return back();
            return redirect(route('books.index'));
        }
        //if true
        return redirect(route('books.index'));
        
    }
    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function logout(){
        Auth::logout();
        return redirect(route('books.index'));
        
    }
}