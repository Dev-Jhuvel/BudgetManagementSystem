<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }
    public function loginPage()
    {
        return view('auth.login');
    }

    public function store()
    {

        // dd(request()->all());
        $validated = request()->validate([
            'name' => 'required|min:5|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->withErrors('message')->with('message', 'Account registration Successfully!');
    }
    public function authenticate()
    {

        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('message', 'Login Sucessfully');
        }

        return redirect()->route('login')->withErrors('message')->with('message', 'Wrong Credentials');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();

        return redirect()->route('login')->with('message', 'Logout Sucessfully');
    }
}
