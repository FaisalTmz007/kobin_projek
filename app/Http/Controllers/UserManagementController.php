<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Supplier;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UserManagementController extends Controller
{
    public function index(){
        return view('admin/ownerManagement');
    }

    public function getOwner(Request $request){
        if ($request->has('cari')) {
            # code...
            $owners = Owner::where('username', 'LIKE', '%' .$request->cari.'%')->get();

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
            $suppliers = Supplier::where('username', 'LIKE', '%' .$request->cari.'%')->get();

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
    
    public function createReset(Request $request) {
        $request->validate([
            'username' => 'required',
            'password'=>'required',
            'role' => 'required',
        ]);

        // dd($request->all());

        if ($request->role == 2) {
            // $owner = Owner::where('username', $request->username)->get();
            $owner = DB::table('owner')->where('username', '=', $request->username)->get();
            if ($owner->count() > 0) {
                $resetPassword = new ResetPassword([
                    'passwordBaru' => $request->password,
                    'fk_owner' => $owner->first()->id_owner,
                    'fk_supplier' => 1
                ]);
            } else {
                return 'error';
            }
        } elseif ($request->role == 3) {
            // $supplier = Supplier::where('username', $request->username)->get();
            $supplier = DB::table('supplier')->where('username', '=', $request->username)->get();
            if ($supplier->count() > 0) {
                // dd($supplier);
                $resetPassword = new ResetPassword([
                    'passwordBaru' => $request->password,
                    'fk_owner' => 1,
                    'fk_supplier' => $supplier->first()->id_supplier
                ]);
            } else {
                return 'error';
            }
        } else {
            return 'errorrrrrrr';
        }
        $resetPassword->save();
        return redirect()->route('login')->with('success', 'Berhasil membuat permintaan');
    }

    public function getResetUser() {
        $dataOwner = DB::table('resetPassword')->join('owner', 'fk_owner', '=', 'id_owner')->select('*')->get();
        $dataSupplier = DB::table('resetPassword')->join('supplier', 'fk_supplier', '=', 'id_supplier')->select('*')->get();

        $merge = $dataOwner->merge($dataSupplier);
        // dd($merge);
        return view('admin/reset-user', ['resetUser' => $merge]);
    }

    public function accResetPassword($id) {
        $currentPath= Route::getFacadeRoot()->current()->uri();

        if ($currentPath == 'admin/reset-user/owner/{id}') {
            # code...
            $owner = Owner::find($id);
            $resetPassword = DB::table('resetPassword')->where('fk_owner', '=', $id)->get();
        }
        elseif ($currentPath == 'admin/reset-user/supplier/{id}') {
            # code...
            $supplier = Supplier::find($id);
            $resetPassword = DB::table('resetPassword')->where('fk_supplier', '=', $id)->get();
        }

        // dd($resetPassword);

        if (isset($owner)) {
            // ubah status transaksi
            DB::table('owner')->where('id_owner', $id)->update(['password'=>Hash::make($resetPassword->first()->passwordBaru)]);

            DB::table('resetPassword')->where('fk_owner', $id)->delete();

            $dataOwner = DB::table('resetPassword')->join('owner', 'fk_owner', '=', 'id_owner')->select('*')->get();
            $dataSupplier = DB::table('resetPassword')->join('supplier', 'fk_supplier', '=', 'id_supplier')->select('*')->get();

            $merge = $dataOwner->merge($dataSupplier);

            // dd($merge);

            return view('admin/reset-user', ['resetUser' => $merge]);
        }
        elseif (isset($supplier)) {
            // ubah status transaksi
            DB::table('supplier')->where('id_supplier', $id)->update(['password'=>Hash::make($resetPassword->first()->passwordBaru)]);

            DB::table('resetPassword')->where('fk_supplier', $id)->delete();

            $dataOwner = DB::table('resetPassword')->join('owner', 'fk_owner', '=', 'id_owner')->select('*')->get();
            $dataSupplier = DB::table('resetPassword')->join('supplier', 'fk_supplier', '=', 'id_supplier')->select('*')->get();

            $merge = $dataOwner->merge($dataSupplier);

            // dd($merge);

            return view('admin/reset-user', ['resetUser' => $merge]);
        }

        return $currentPath;
    }
}
