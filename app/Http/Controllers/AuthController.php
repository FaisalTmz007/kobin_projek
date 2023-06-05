<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register_user(){
        return view('user/register');
    }

    public function register_action(Request $request)
    {
        if ($request->role == 2) {
            # code...
            // dd($request->all());
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:owner',
                'password' => 'required',
                'telp' => 'required',
                'alamat' => 'required',
                'role' => 'required',
                'gambar' => 'required|image|mimes:png,jpg|max:2048'
            ], [
                'name.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'username.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'password.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'telp.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'alamat.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'role.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'gambar.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
            ]);

            $gambar = $request->gambar;
            $slug = Str::slug($gambar->getClientOriginalName());
            $new_gambar = time() . '_' . $slug;
            $gambar->move('uploads/mahasiswa/', $new_gambar);

            $owner = new Owner([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'role' => $request->role,
                'gambar' => $request->$gambar = 'uploads/mahasiswa/'.$new_gambar,
            ], [
                'name.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'username.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'password.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'telp.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'alamat.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'role.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'gambar.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
            ]);
            // dd($request->all());
            $owner->save();
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
        }
        if ($request->role == 3) {
            # code...
            // return 'role = 2';
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:supplier',
                'password' => 'required',
                'telp' => 'required',
                'alamat' => 'required',
                'role' => 'required',
                'gambar' => 'required|image|mimes:png,jpg|max:2048'
            ], [
                'name.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'username.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'password.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'telp.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'alamat.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'role.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
                'gambar.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
            ]);
            
            $gambar = $request->gambar;
            $slug = Str::slug($gambar->getClientOriginalName());
            $new_gambar = time() . '_' . $slug;
            $gambar->move('uploads/mahasiswa/', $new_gambar);

            $supplier = new Supplier([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'telp' => $request->telp,
                'alamat' => $request->alamat,
                'role' => $request->role,
                'gambar' => $request->$gambar = 'uploads/mahasiswa/'.$new_gambar,
            ]);
            $supplier->save();
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
        }
        return back()->withErrors([
            'username' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
        ]);
    }

    public function login(){
        return view('user/login');
    }

    public function login_action(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ], [
            'username.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
            'password.required' => 'Kesalahan pengisian form untuk mengisi kembali form yang salah.',
        ]);
 
        if (Auth::guard('owner')->attempt($credentials)) {
            $request->session()->regenerate();
            // dd($request->all());
            return redirect()->intended('user/home')->with('success', 'Berhasil Login Sebagai User');
        }

        if (Auth::guard('supplier')->attempt($credentials)) {
            $request->session()->regenerate();
            // dd($request->all());
            return redirect()->intended('user/home')->with('success', 'Berhasil Login Sebagai User');
        }
 
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

    public function resetPassword(Request $request){
        return view('user/reset-password');
    }
}
