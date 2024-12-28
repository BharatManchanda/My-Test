<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticatedController extends Controller
{
    //
    public function login(Request $request) {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if (Auth::attempt($validated)) {
                return redirect()->route('leads.index');
            }
    
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->withInput(); 
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function showLoginForm() {
        if (Auth::check()) {
            return redirect()->route('leads.index');
        }
        return view('auth.login');
    }

    public function register(Request $request) {
        try {
            if (Auth::check()) {
                return redirect()->route('leads.index');
            }
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            Auth::login($user);
            return redirect()->route('leads.index');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
