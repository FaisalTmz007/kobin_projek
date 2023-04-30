<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Supplier;

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

        return view('user/jelajah', ['own' => $owner, 'supp' => $supplier]);
    }
}
