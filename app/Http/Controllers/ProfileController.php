<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Owner;
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
}
