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
            ]);
            // dd($request->all());
            $owner->save();
            return redirect()->route('login')->with('success', 'Berhasil registrasi sebagai owner');
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
            return redirect()->route('login')->with('success', 'Berhasil registrasi sebagai supplier');
        }
    }

    public function login(){
        return view('user/login');
    }

    public function login_action(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::guard('owner')->attempt($credentials)) {
            $request->session()->regenerate();
            // dd($request->all());
            return redirect()->intended('user/home')->with('loginowner', 'Anda Berhasil Masuk Sebagai Pemilik Kebun');
        }

        if (Auth::guard('supplier')->attempt($credentials)) {
            $request->session()->regenerate();
            // dd($request->all());
            return redirect()->intended('user/home')->with('loginsupplier', 'Anda Berhasil Masuk Sebagai Supplier');
        }
 
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');

    }

    public function password(){
        return view('user/password');
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);
        // dd($request->all());

        if (Auth::guard('owner')->check()) {
            #Match The Old Password
            if(!Hash::check($request->old_password, auth('owner')->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
            // dd('halo');
            #Update the new Password
            Owner::where('id_owner', auth('owner')->user()->id_owner)->update(['password' => Hash::make($request->new_password)]);


            return back()->with('success', 'Password Changed!');
        } elseif(Auth::guard('supplier')->check()) {
            #Match The Old Password
            if(!Hash::check($request->old_password, auth('supplier')->user()->password)){
                return back()->with("error", "Old Password Doesn't match!");
            }
            // dd('halo');
            #Update the new Password
            Supplier::where('id_supplier', auth('supplier')->user()->id_supplier)->update(['password' => Hash::make($request->new_password)]);

            return back()->with('success', 'Password Changed!');
        }

        
    }
}
