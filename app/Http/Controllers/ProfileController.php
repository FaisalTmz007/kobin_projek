<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Owner;

class ProfileController extends Controller
{
    public function index(){
        return view('user/ubah-profile');
    }

    public function editOwner(Request $request, $id){
        $data = $request->all();

        // dd($data);
            
        Owner::where('id_owner', $id)->update(['name'=> $data['name'], 'username'=>$data['username'], 'telp'=>$data['telp'], 'alamat'=>$data['alamat']]);
        return redirect()->intended('user/profile');
    }

    public function editSupplier(Request $request, $id){
        $data = $request->all();

        // dd($data);
            
        Supplier::where('id_supplier', $id)->update(['name'=> $data['name'], 'username'=>$data['username'], 'telp'=>$data['telp'], 'alamat'=>$data['alamat']]);
        return redirect()->intended('user/profile');
    }
}
