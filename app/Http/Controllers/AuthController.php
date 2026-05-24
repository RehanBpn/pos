<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Email;

class AuthController extends Controller
{
    public function view()
    {
        return view('login.index');
    }
    public function viewSign ()
    {
        return view('login.signin');
    }

    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email','password'))) {
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'email atau password salah'
    ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('login.view');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }
}