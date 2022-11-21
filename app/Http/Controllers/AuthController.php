<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->has('is_admin')) {
                return redirect()->intended('/dashboard/index');
            } else {
                return redirect()->intended('/');
            }
        }


        return back()->with('error', 'Email/Password salah');
    }

    public function logout(Request $request)
    {
        $role = auth()->user()->roles->first()->name;
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($role == 'customer') {
            return redirect('/login');
        } else {
            return redirect('/loginadmin');
        }
    }

    public function loginadmin()
    {
        return view('auth.admin.login');
    }

    public function login()
    {
        return view('auth.customer.login', [
            'title' => 'Login User'
        ]);
    }

    public function register()
    {
        return view('auth.customer.register', [
            'title' => 'Daftar Akun'
        ]);
    }

    public function create(UserRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('user.login')->with('success', 'Berhasil mendaftarkan akun');
    }
}
