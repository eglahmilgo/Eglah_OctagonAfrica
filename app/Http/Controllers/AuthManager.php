<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller


{
    function login(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }
    
    function registration(){
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }
    
    function loginPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required_if:auth_method,password'
        ]);

        $credentials = $request->only('email', 'password');
        if ($request->auth_method == 'fingerprint') {
        } else {
            if (Auth::attempt($credentials)) {
                return redirect()->intended(route('home'));
            }
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }

    public function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'auth_method' => 'required' // Ensure the user selects an authentication method
        ]);
        

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['auth_method'] = $request->auth_method;

        if ($request->auth_method == 'fingerprint') {
            
        } else {
            $data['password'] = Hash::make($request->password);
        }

        $user = User::create($data);

        if (!$user) {
            return redirect(route('registration'))->with("error", "Registration failed, try again");
        }

        return redirect(route('login'))->with("success", "Successful Registration, Login to access the app");
    }





    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));

    }
}



