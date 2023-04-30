<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Supplier;

class UserManagementController extends Controller
{
    public function index(){
        return view('admin/ownerManagement');
    }
 
    // public function getUser(Request $request){
    //     if ($request->has('cari')) {
    //         # code...
    //         $owners = Owner::where('name', 'LIKE', '%' .$request->cari.'%');
    //         $suppliers = Supplier::where('name', 'LIKE', '%' .$request->cari.'%');

    //         // dd($owners);
    //         // dd($suppliers);
    //     } else {
    //         # code...
    //         $owners = Owner::all();
    //         $suppliers = Supplier::all();
    //     }
    //     // dd($owners);
    //     // dd($suppliers);
    //     return view('admin/userManagement')->with(['owners' => $owners, 'suppliers' => $suppliers]);
    // }

    public function getOwner(Request $request){
        if ($request->has('cari')) {
            # code...
            $owners = Owner::where('name', 'LIKE', '%' .$request->cari.'%')->get();

            // dd($owners);
            // dd($suppliers);
        } else {
            # code...
            $owners = Owner::all();
        }
        // dd($owners);
        // dd($suppliers);
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

            // dd($data);
            
            Owner::where('id_owner', $id)->update(['name'=> $data['name'], 'username'=>$data['username'], 'telp'=>$data['telp'], 'alamat'=>$data['alamat']]);
            return redirect()->back();
        }
    }
    public function editSupplier(Request $request, $id){
        
        if ($request->isMethod('post')) {
            $data = $request->all();

            // dd($data);
            
            Supplier::where('id_supplier', $id)->update(['name'=> $data['name'], 'username'=>$data['username'], 'telp'=>$data['telp'], 'alamat'=>$data['alamat']]);
            return redirect()->back();
        }
    }
    
}
