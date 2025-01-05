<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $roles = Auth::user()->roles->pluck('name'); // Mengambil nama role pengguna
            if ($roles->contains('admin')) {
                return redirect()->route('summary');
            } elseif ($roles->contains('user')) {
                return redirect()->route('summary');
            }

            return redirect()->route('home')->withErrors(['role' => 'Unauthorized role']);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

}
