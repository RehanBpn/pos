<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function view()
    {
        return view('login.index');
    }

    public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'email atau password salah'
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }
}