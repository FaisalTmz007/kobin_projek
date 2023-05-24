<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CoffeePriceController extends Controller
{
    public function getPrice(){
        // $response = Http::withHeaders([
        //     'key' => '971FIL70FW6RX7EC'
        // ])->get('https://www.alphavantage.co/query?function=COFFEE&interval=monthly&apikey=');

        $response = Http::get('https://www.alphavantage.co/query?function=COFFEE&interval=monthly&apikey=971FIL70FW6RX7EC')->collect();

        // dd($response['data']);
        $count = count($response);
        $data = $response['data'];

        return view('user/harga-kopi', ['data' => $data, 'count' => $count]); 
    }
}
