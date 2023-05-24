<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function index(){
        return view('user/ubah-profile');
    }

    public function editOwner(Request $request, $id){
        $data = $request->all();

        $owner = Owner::find($id);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'required|image|mimes:png,jpg|max:2048'
            ]);
            File::delete($owner->gambar);
            $gambar = $request->gambar;
            $slug = Str::slug($gambar->getClientOriginalName());
            $new_gambar = time() . '_' . $slug;
            $gambar->move('uploads/mahasiswa/', $new_gambar);
        }

        // dd($data);
            
        Owner::where('id_owner', $id)->update(['name'=> $data['name'], 'username'=>$data['username'], 'telp'=>$data['telp'], 'alamat'=>$data['alamat'], 'gambar' => $request->$gambar = 'uploads/mahasiswa/'.$new_gambar,]);
        return redirect()->intended('user/profile')->with('edit', 'Berhasil mengubah data');
    }

    public function editSupplier(Request $request, $id){
        $data = $request->all();

        $supplier = Supplier::find($id);

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'required|image|mimes:png,jpg|max:2048'
            ]);
            File::delete($supplier->gambar);
            $gambar = $request->gambar;
            $slug = Str::slug($gambar->getClientOriginalName());
            $new_gambar = time() . '_' . $slug;
            $gambar->move('uploads/mahasiswa/', $new_gambar);
        }

        // dd($data);
            
        Supplier::where('id_supplier', $id)->update(['name'=> $data['name'], 'username'=>$data['username'], 'telp'=>$data['telp'], 'alamat'=>$data['alamat'], 'gambar' => $request->$gambar = 'uploads/mahasiswa/'.$new_gambar,]);
        return redirect()->intended('user/profile')->with('edit', 'Berhasil mengubah data');
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
