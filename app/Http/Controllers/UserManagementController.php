<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Supplier;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function index(){
        return view('admin/ownerManagement');
    }

    public function getOwner(Request $request){
        if ($request->has('cari')) {
            # code...
            $owners = Owner::where('name', 'LIKE', '%' .$request->cari.'%')->get();

            // dd($owners);
        } else {
            # code...
            $owners = Owner::all();
        }
        // dd($owners);
        return view('admin/ownerManagement')->with(['owners' => $owners]);
    }

    public function getSupplier(Request $request){
        if ($request->has('cari')) {
            # code...
            $suppliers = Supplier::where('name', 'LIKE', '%' .$request->cari.'%')->get();

            // dd($owners);
            // dd($suppliers);
        } else {
            # code...
            $suppliers = Supplier::all();
        }
        // dd($owners);
        // dd($suppliers);
        return view('admin/supplierManagement')->with(['suppliers' => $suppliers]);
    }

    // Edit
    public function editOwner(Request $request, $id){
        
        if ($request->isMethod('post')) {
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
            return redirect()->back()->with('edit', 'Berhasil mengubah data');
        }
    }

    public function passwordOwner(Request $request, $id) {
        $request->validate([
            'password' => 'required',
        ]);

        if ($request->isMethod('post')) {
            $data = $request->all();

            // dd($data);            
            Owner::where('id_owner', $id)->update(['password'=> Hash::make($data['password'])]);
            return redirect()->back()->with('password', 'Berhasil mereset password');
        }
    }

    public function editSupplier(Request $request, $id){
        
        if ($request->isMethod('post')) {
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
            return redirect()->back()->with('edit', 'Berhasil mengubah data');
        }
    }

    public function passwordSupplier(Request $request, $id) {
        $request->validate([
            'password' => 'required',
        ]);
        
        if ($request->isMethod('post')) {
            $data = $request->all();

            // dd($data);            
            Supplier::where('id_supplier', $id)->update(['password'=> Hash::make($data['password'])]);
            return redirect()->back()->with('password', 'Berhasil mereset password');
        }
    }
    
}
