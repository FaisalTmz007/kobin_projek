<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ResiController extends Controller
{
    public function index() {
        // $response = Http::withHeaders([
        //     'key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490'
        // ])->get('https://api.binderbyte.com/v1/track?api_key=ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490d&courier=jne&awb=8825112045716759');

        $response = Http::get('https://api.binderbyte.com/v1/list_courier', [
            // 'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            'api_key' => 'b28292a23dcfb39a895ba1bd0dffa1c32491e00de25c09e991f9171048649ef6',
        ])->collect();
        // sleep(5);

        // dd($response);
        // echo $response[0]['code'];
        return view('user/cek-resi', ['ekspedisi' => $response, 'response_status' => 0]);
    }

    public function cekResi(Request $request)
    {
        $responseCourier = Http::get('https://api.binderbyte.com/v1/list_courier', [
            // 'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            'api_key' => 'b28292a23dcfb39a895ba1bd0dffa1c32491e00de25c09e991f9171048649ef6',
        ])->collect();


        $response = Http::get('https://api.binderbyte.com/v1/track', [
            // 'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            'api_key' => 'b28292a23dcfb39a895ba1bd0dffa1c32491e00de25c09e991f9171048649ef6',
            'courier' => $request->courier,
            'awb' => $request->awb,
        ]);

        // $responseResi = Http::post('https://api.binderbyte.com/v1/track', [
        //     'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            
        // ]);

        $response_status = $response['status'];

        // dd($response->json());
        if ($response_status == 200) {
            # code...
            $summary = $response['data']['summary'];
            $detail = $response['data']['detail'];
            $history = $response['data']['history'];
            return view('user/cek-resi', ['response_status' => $response_status ,'ekspedisi' => $responseCourier, 'summary' => $summary, 'detail' => $detail, 'history' => $history]);
        } elseif($response_status == 400) {
            return view('user/cek-resi', ['response_status' => $response_status, 'ekspedisi' => $responseCourier,]);
        }
    }
}
