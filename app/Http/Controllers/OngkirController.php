<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'key' => 'd7db490e5f122cedcbe9fbfc91ece45b'
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response['rajaongkir']['results'];

        // dd($response->json());

        return view('user/cek-ongkir', ['cities' => $cities, 'ongkir' => '']);
    }

    public function cekOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => 'd7db490e5f122cedcbe9fbfc91ece45b'
        ])->get('https://api.rajaongkir.com/starter/city');

        $responseCost = Http::withHeaders([
            'key' => 'd7db490e5f122cedcbe9fbfc91ece45b'
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        // dd($responseCost->json());

        $cities = $response['rajaongkir']['results'];
        $ongkir = $responseCost['rajaongkir'];

        // dd($response->all());

        return view('user/cek-ongkir', ['cities' => $cities, 'ongkir' => $ongkir]);
    }
}
