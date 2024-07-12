<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index(){
        return view('register.create');
    }

    public function store(){
        
        $formData=request()->validate([
            "name"=>['required','min:3','max:255'],
            "username"=>['required'],
            "email"=>['required','email'],
            "password"=>['required','min:6']
        ]);
        
        $user=User::create($formData);
        auth()->login($user);
        return redirect('/')->with('success',"Welcome,".$user->name);
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success',"Hope To See You Again");
    }
    public function login(){
        return view('auth.login');
    }
    public function post_login(){
        $formData=request()->validate([
            'email'=>['required',Rule::exists('users','email')],
            'password'=>['required'],
        ],[
            "email.required"=>"You must fill your email",
            "password.required"=>"You must fill your password"
        ]);

        if(auth()->attempt($formData)){
            if(auth()->user()->is_admin){
                return redirect('/admin/blogs');
            }else{
                return redirect()->with("success","Welcome Back");
            }
        }else{
            return redirect()->back()->withErrors([
                'email'=>"User Credentials wrong"
            ]);
        }
    }

    
}
