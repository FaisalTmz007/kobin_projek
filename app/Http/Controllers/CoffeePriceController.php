<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CoffeePriceController extends Controller
{
    public function convertToRupiah($valueInCents)
    {
        $exchangeRate = 14400; // Assume exchange rate: 1 USD = 14,400 IDR

        // Convert the valueInCents to a numeric value using floatval or intval
        $cents = floatval($valueInCents); // or intval($valueInCents)

        $valueInRupiah = $cents * $exchangeRate;

        // Round the value to 2 decimal places
        $roundedValue = round($valueInRupiah, 2);

        return $roundedValue;
    }


    public function getPrice()
    {
        // dd(Auth::guard('supplier')->user()->premium);
        if (Auth::guard('owner')->check() && Auth::guard('owner')->user()->premium == 1 || Auth::guard('supplier')->check() && Auth::guard('supplier')->user()->premium == 1) {
            # code...
        
            // dd($premium);
        
            $response = Http::get('https://www.alphavantage.co/query?function=COFFEE&interval=monthly&apikey=971FIL70FW6RX7EC')->json();

            $data = collect($response['data']);

            // Iterate over the data and convert the value to Rupiah
            $data = $data->map(function ($item) {
                $valueInCents = $item['value'];
                $valueInRupiah = $this->convertToRupiah($valueInCents);
                $formattedValue = 'Rp. ' . number_format($valueInRupiah, 2, ',', '.') . '/pound';
                $item['value'] = $formattedValue;

                return $item;
            });

            $currentPage = Paginator::resolveCurrentPage();
            $perPage = 25;
            $items = $data->slice(($currentPage - 1) * $perPage, $perPage)->all();
            $paginatedData = new LengthAwarePaginator($items, count($data), $perPage, $currentPage);
            $paginatedData->setPath(url()->current());

            return view('user.harga-kopi', ['data' => $paginatedData, 'count' => count($data)]);
        }
        else {
            //DB jenis paket
            $premium = DB::table('jenis_paket')->select('id', 'jenis_paket', 'harga')->get();
            return view('user.premium.index', ['premium' => $premium]);
        }

    }
}
