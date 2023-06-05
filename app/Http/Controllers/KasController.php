<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kas;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('owner')->check()) {
            $kas = DB::table('kas')->where('id_owner', '=', Auth::guard('owner')->user()->id_owner)->get();
        }
        elseif (Auth::guard('supplier')->check()) {
            $kas = DB::table('kas')->where('id_supplier', '=', Auth::guard('supplier')->user()->id_supplier)->get();
        }

        // return Auth::guard('supplier')->user()->name;
        // dd($kas);
        return view('user/kas/index', ['kas' => $kas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/kas/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $userId = Auth::id();

        $request->validate([
            'tanggal' => 'required',
            'jumlah_masuk' => 'required',
            'jumlah_keluar' => 'required',
        ]);

        if (Auth::guard('owner')->check()) {
            $userId = Auth::guard('owner')->user()->id_owner;

            $keterangan = '';

            if ($request->filled('keterangan')) {
                # code...
                $keterangan = $request->keterangan;
            };

            $kas = new Kas([
                'tanggal' => $request->tanggal,
                'jumlah_masuk' => $request->jumlah_masuk,
                'jumlah_keluar' => $request->jumlah_keluar,
                'keterangan' => $keterangan,
                'id_owner' => $userId,
                'id_supplier' => 1,
            ]);
        }
        
        elseif (Auth::guard('supplier')->check()) {
            $userId = Auth::guard('supplier')->user()->id_supplier;

            $keterangan = '';

            if ($request->filled('keterangan')) {
                # code...
                $keterangan = $request->keterangan;
            };

            $kas = new Kas([
                'tanggal' => $request->tanggal,
                'jumlah_masuk' => $request->jumlah_masuk,
                'jumlah_keluar' => $request->jumlah_keluar,
                'keterangan' => $keterangan,
                'id_owner' => 1,
                'id_supplier' => $userId,
            ]);
        }
        $kas->save();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = kas::where('id', $id)->first();
        return view('user/kas.edit')->with('data', $data);
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
        $request->validate([
            'tanggal' => 'required',
            'jumlah_masuk' => 'required',
            'jumlah_keluar' => 'required',
        ]);

        if (Auth::guard('owner')->check()) {
            $userId = Auth::guard('owner')->user()->id_owner;
            $keterangan = '';

            if ($request->filled('keterangan')) {
                # code...
                $keterangan = $request->keterangan;
            };
            $kas = new Kas([
                'tanggal' => $request->tanggal,
                'jumlah_masuk' => $request->jumlah_masuk,
                'jumlah_keluar' => $request->jumlah_keluar,
                'keterangan' => $keterangan,
                'id_owner' => $userId,
                'id_supplier' => 1,
            ]);
        }
        
        elseif (Auth::guard('supplier')->check()) {
            $userId = Auth::guard('supplier')->user()->id_supplier;
            $keterangan = '';

            if ($request->filled('keterangan')) {
                # code...
                $keterangan = $request->keterangan;
            };
            $kas = new Kas([
                'tanggal' => $request->tanggal,
                'jumlah_masuk' => $request->jumlah_masuk,
                'jumlah_keluar' => $request->jumlah_keluar,
                'keterangan' => $keterangan,
                'id_owner' => 1,
                'id_supplier' => $userId,
            ]);
        }
        Kas::where('id', $id)->update($kas->toArray());
        return redirect()->to('user/kas')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function incomeTotal()
    {
        if (Auth::guard('owner')->check()) {
            $kas = DB::table('kas')->where('id_owner', '=', Auth::guard('owner')->user()->id_owner)->get();
            $group_total = Kas::select(DB::raw("CAST(SUM(jumlah_masuk-jumlah_keluar) as int) as group_total"))->where('id_owner', '=', Auth::guard('owner')->user()->id_owner)->GroupBy(DB::raw("Month(tanggal)"))->pluck('group_total');
            $bulan_total = Kas::select(DB::raw("MONTHNAME(tanggal) as bulan_total"))->where('id_owner', '=', Auth::guard('owner')->user()->id_owner)->GroupBy(DB::raw("MONTHNAME(tanggal)"))->pluck('bulan_total');
            // dd($bulan_total);
        } elseif (Auth::guard('supplier')->check()) {
            $kas = DB::table('kas')->where('id_supplier', '=', Auth::guard('supplier')->user()->id_supplier)->get();
            $group_total = Kas::select(DB::raw("CAST(SUM(jumlah_masuk-jumlah_keluar) as int) as group_total"))->where('id_supplier', '=', Auth::guard('supplier')->user()->id_supplier)->GroupBy(DB::raw("Month(tanggal)"))->pluck('group_total');
            $bulan_total = Kas::select(DB::raw("MONTHNAME(tanggal) as bulan_total"))->where('id_supplier', '=', Auth::guard('supplier')->user()->id_supplier)->GroupBy(DB::raw("MONTHNAME(tanggal)"))->pluck('bulan_total');
            // dd($group_total);
        }

        // Get the current month
        $currentMonth = Carbon::now()->format('M');

        // Get the current year
        $currentYear = Carbon::now()->format('Y');

        $startDate = new \DateTime($currentYear . '-' . $currentMonth . '-' . '01');
        $endDate = new \DateTime($currentYear . '-' . $currentMonth . '-' . '31');

        $interval = \DateInterval::createFromDateString('1 day');
        $period = new \DatePeriod($startDate, $interval, $endDate);

        $incomeTotal = 0;
        $outcomeTotal = 0;

        foreach ($period as $date) {
            $carbonInstance = Carbon::parse($date);

            // Format the Carbon instance to 'YYYY-MM-DD' format
            $formattedDate = $carbonInstance->format('Y-m-d');

            foreach ($kas as $item) {
                if ($item->tanggal == $formattedDate) {
                    $incomeTotal += $item->jumlah_masuk;
                    $outcomeTotal += $item->jumlah_keluar;
                }
            }
        }
        $total = $incomeTotal - $outcomeTotal;

        // dd($group_total);

        return view('user/home', compact('incomeTotal', 'outcomeTotal', 'total', 'group_total', 'bulan_total'));
    }

}
