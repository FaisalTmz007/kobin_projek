<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CoffeePriceController extends Controller
{
    public function getPrice()
    {
        // dd(Auth::guard('supplier')->user()->premium);
        if (Auth::guard('owner')->check() && Auth::guard('owner')->user()->premium == 1 || Auth::guard('supplier')->check() && Auth::guard('supplier')->user()->premium == 1) {
            # code...
        
            // dd($premium);
        
            $response = Http::get('https://www.alphavantage.co/query?function=COFFEE&interval=monthly&apikey=971FIL70FW6RX7EC')->json();
        
            $data = collect($response['data']); // Mengubah array menjadi koleksi (Collection)
            $currentPage = Paginator::resolveCurrentPage(); // Mengambil halaman saat ini
        
            // Membagi koleksi menjadi beberapa halaman
            $perPage = 25; // Jumlah data per halaman
            $items = $data->slice(($currentPage - 1) * $perPage, $perPage)->all();
            // $paginatedData = new Paginator($items, $perPage, $currentPage);
            $paginatedData = new LengthAwarePaginator($items, count($data), $perPage, $currentPage);
            $paginatedData->setPath(url()->current());
                
        
            // return $paginatedData;
            return view('user.harga-kopi', ['data' => $paginatedData, 'count' => count($data)]);
        }
        else {
            //DB jenis paket
            $premium = DB::table('jenis_paket')->select('id', 'jenis_paket', 'harga')->get();
            return view('user.premium.index', ['premium' => $premium]);
        }

    }
}
