<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    public function login_admin(){
        return view('admin/login');
    }

    public function login_admin_action(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
            'password.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
        ]);
 
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            // dd($request->all());
            return redirect()->intended('admin/home')->with('success', 'Berhasil Login Sebagai Admin');;
        }
        // dd($request->all());
 
        return back()->withErrors([
            'username' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');

    }
}
