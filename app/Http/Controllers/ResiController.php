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
            'api_key' => '2b4e335ede428e0372f55ef2a7184cda1073cd27bfa2a8c07bc71d627962a932',
        ])->collect();
        // sleep(5);

        // dd($response);
        // echo $response[0]['code'];



        return view('user/cek-resi', ['ekspedisi' => $response, 'summary' => ['awb'=>'', 'date'=>''], 'detail' => ['shipper'=>'', 'receiver'=>''], 'history' => [['date'=>'', 'desc'=>'']]]);
    }

    public function cekResi(Request $request)
    {
        $responseCourier = Http::get('https://api.binderbyte.com/v1/list_courier', [
            // 'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            'api_key' => '2b4e335ede428e0372f55ef2a7184cda1073cd27bfa2a8c07bc71d627962a932',
        ])->collect();


        $response = Http::get('https://api.binderbyte.com/v1/track', [
            // 'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            'api_key' => '2b4e335ede428e0372f55ef2a7184cda1073cd27bfa2a8c07bc71d627962a932',
            'courier' => $request->courier,
            'awb' => $request->awb,
        ]);

        // $responseResi = Http::post('https://api.binderbyte.com/v1/track', [
        //     'api_key' => 'ad0fc72a8595a4f400df6beb7bc264fb166a9db3cce5131be5d5a2af2bf49490',
            
        // ]);

        // dd($response->json());

        $summary = $response['data']['summary'];
        $detail = $response['data']['detail'];
        $history = $response['data']['history'];


        // dd($response->all());

        return view('user/cek-resi', ['ekspedisi' => $responseCourier, 'summary' => $summary, 'detail' => $detail, 'history' => $history]);
    }
}
