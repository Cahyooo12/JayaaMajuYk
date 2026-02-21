<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class AdminAuthController extends Controller
{
    public function login()
    {
        if (session('user') === 'admin') {
            return redirect()->route('admin.products.index');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        if ($username === 'admin' && $password === 'admin123') {
            session(['user' => 'admin']);
            return redirect()->route('admin.products.index');
        }

        return redirect()->back()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('admin.login');
    }
}
