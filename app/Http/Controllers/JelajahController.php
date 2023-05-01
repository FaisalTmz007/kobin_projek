<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Supplier;
use Illuminate\Support\Facades\Redis;

class JelajahController extends Controller
{
    public function show(Request $request) {

        if($request->has('search')){
            $owner = Owner::where('name', 'LIKE', '%' .$request->search.'%')->with('getRole')->get();
            $supplier = Supplier::where('name', 'LIKE', '%' .$request->search.'%')->with('ambilRole')->get();
        }
        else{
            $owner = Owner::with('getRole')->get();
            $supplier = Supplier::with('ambilRole')->get();
        }

        // $user = array();
        $user = $owner->merge($supplier);
        // $user->json_encode();
        // dd($user);

        // $data = $owner . $supplier;
        // dd($data);

        return view('user/jelajah', ['user' => $user, 'own' => $owner, 'supp' => $supplier]);
    }
}
