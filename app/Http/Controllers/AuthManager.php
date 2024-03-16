<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function registration()
    {
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('registration');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'name' => 'required',

            'email' => 'required|email',
            'password' => 'required',
            'useFingerprint' => 'nullable|boolean'

        ]);

        $credentials = $request->only('name', 'email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended(route('home'));
        }

        return redirect(route('login'))->with("error", "Invalid credentials. Please try again.");
    }

    public function registrationPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'useFingerprint' => 'nullable|boolean',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            if ($request->filled('useFingerprint')) {
                $userData['use_fingerprint'] = true; 
            }
            // Set success message in session
            $request->session()->flash('success', 'Registration successful. You can now log in.');

            
            return redirect(route('login'));
        }

        return redirect(route('registration'))->with("error", "Registration failed. Please try again.");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
