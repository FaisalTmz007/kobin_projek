<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Premium;
use Illuminate\Support\Facades\DB;
use App\Models\Owner;
use App\Models\Supplier;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class PremiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user/premium/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->input('jenisPaket'));

        if (Auth::guard('owner')->check()) {
            $userId = Auth::guard('owner')->user()->id_owner;

            $bukti = $request->bukti;
            $slug = Str::slug($bukti->getClientOriginalName());
            $new_bukti = time() . '_' . $slug;
            $bukti->move('uploads/bukti/', $new_bukti);

            $premium = new Premium([
                'fk_owner' => $userId,
                'fk_supplier' => 1,
                'fk_jenis_paket' => $request->jenisPaket,
                'bukti' => $request->$bukti = 'uploads/bukti/'.$new_bukti,
            ]);
        }
        
        elseif (Auth::guard('supplier')->check()) {
            $userId = Auth::guard('supplier')->user()->id_supplier;

            $bukti = $request->bukti;
            $slug = Str::slug($bukti->getClientOriginalName());
            $new_bukti = time() . '_' . $slug;
            $bukti->move('uploads/bukti/', $new_bukti);

            $premium = new Premium([
                'fk_owner' => 1,
                'fk_supplier' => $userId,
                'fk_jenis_paket' => $request->jenisPaket,
                'bukti' => $request->$bukti = 'uploads/bukti/'.$new_bukti,
            ]);
        }
        $premium->save();
        return redirect()->route('harga-kopi')->with('bukti', 'Bukti terkirim, tunggu verifikasi oleh admin');
        // return view('user/premium/done')->with('success', 'Berhasil mengirim bukti pembayaran');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $id;
        return view('user.premium.create',['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function getTransaksi() {
        // $transaksis = DB::table('transaksi')->select('*')->get();
        $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 0)->get();
        $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 0)->get();

        $merge = $transaksiOwner->merge($transaksiSupplier);

        // dd($merge);
        // foreach ($transaksis as $transaksi) {
        //     dd($transaksi);
        // }

        
        // dd($dataTransaksi);
        return view('admin/premium', ['merge' => $merge]);
    }

    public function deleteTransaksi($id) {
        $ambilBukti = DB::table('transaksi')->where('id', $id)->get();
        // dd($ambilBukti);
        File::delete($ambilBukti->first()->bukti);

        DB::table('transaksi')->where('id', $id)->delete();


        $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 0)->get();
        $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 0)->get();
        $merge = $transaksiOwner->merge($transaksiSupplier);

        // dd($merge);

        return back()->with(compact('merge'))->with('success', 'Refund terkonfirmasi');
        // return 'Halo';
    }

    public function accTransaksi($id){
        $currentPath= Route::getFacadeRoot()->current()->uri();

        if ($currentPath == 'admin/premium/owner/{id}') {
            # code...
            $owner = Owner::find($id);
        }
        elseif ($currentPath == 'admin/premium/supplier/{id}') {
            # code...
            $supplier = Supplier::find($id);
        }
        

        if (isset($owner)) {
            // ubah status transaksi
            DB::table('owner')->where('id_owner', $id)->update(['premium'=>true]);

            // ubah status premium
            DB::table('transaksi')->where('fk_owner', $id)->update(['status'=>true]);
            $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 0)->get();
            $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 0)->get();
            $merge = $transaksiOwner->merge($transaksiSupplier);

            // dd($merge);

            return back()->with(compact('merge'))->with('success', 'Pembayaran terkonfirmasi');
        }
        elseif (isset($supplier)) {
            // ubah status transaksi
            DB::table('supplier')->where('id_supplier', $id)->update(['premium'=>true]);

            // ubah status premium
            DB::table('transaksi')->where('fk_supplier', $id)->update(['status'=>true]);
            $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 0)->get();
            $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 0)->get();
            $merge = $transaksiOwner->merge($transaksiSupplier);

            // dd($merge);

            return back()->with(compact('merge'))->with('success', 'Pembayaran terkonfirmasi');
        }
    }

    public function getdecTransaksi() {
        // $transaksis = DB::table('transaksi')->select('*')->get();
        $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 1)->get();
        $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 1)->get();

        $merge = $transaksiOwner->merge($transaksiSupplier);

        // dd($merge);
        // foreach ($transaksis as $transaksi) {
        //     dd($transaksi);
        // }

        
        // dd($dataTransaksi);
        return view('admin/deactive-premium', ['merge' => $merge]);
    }


    public function decTransaksi($id) {
        $currentPath= Route::getFacadeRoot()->current()->uri();

        if ($currentPath == 'admin/premium/owner/deactive/{id}') {
            # code...
            $owner = Owner::find($id);
        }
        elseif ($currentPath == 'admin/premium/supplier/deactive/{id}') {
            # code...
            $supplier = Supplier::find($id);
        }

        if (isset($owner)) {
            // ubah status transaksi
            DB::table('owner')->where('id_owner', $id)->update(['premium'=>false]);

            // delete transaksi
            $ambilBukti = DB::table('transaksi')->where('fk_owner', $id)->get();
            // dd($ambilBukti->first()->bukti);
            File::delete($ambilBukti->first()->bukti);
            DB::table('transaksi')->where('fk_owner', $id)->delete();
            $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 1)->get();
            $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 1)->get();
            $merge = $transaksiOwner->merge($transaksiSupplier);

            // dd($merge);
            return back()->with(compact('merge'))->with('success', 'Berhasil menonaktifkan paket');
            // return view('admin/deactive-premium', ['merge' => $merge]);
        }
        elseif (isset($supplier)) {
            // ubah status transaksi
            DB::table('supplier')->where('id_supplier', $id)->update(['premium'=>false]);

            // delete transaksi
            $ambilBukti = DB::table('transaksi')->where('fk_supplier', $id)->get();
            // dd($ambilBukti->first()->bukti);
            File::delete($ambilBukti->first()->bukti);
            DB::table('transaksi')->where('fk_supplier', $id)->delete();
            $transaksiOwner = DB::table('transaksi')->join('owner', 'fk_owner', '=', 'id_owner')->where('status', '=', 1)->get();
            $transaksiSupplier = DB::table('transaksi')->join('supplier', 'fk_supplier', '=', 'id_supplier')->where('status', '=', 1)->get();
            $merge = $transaksiOwner->merge($transaksiSupplier);

            // dd($merge);
            return back()->with(compact('merge'))->with('success', 'Berhasil menonaktifkan paket');
            // return view('admin/deactive-premium', ['merge' => $merge]);
        }
    }

}
