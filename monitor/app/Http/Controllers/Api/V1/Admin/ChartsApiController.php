<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speed;
use App\Models\LogNotifikasi;
use DB;
use Carbon\Carbon;


class ChartsApiController extends Controller
{

    public function index()
    {
        Speed::create(['speed' => rand(30,70)]);

        $speeds = Speed::latest()->take(30)->get()->sortBy('id');
       
        $labels = $speeds->pluck('id');
        $data = $speeds->pluck('speed');

        return response()->json(compact('labels', 'data'));
    }


    public function gettransaksi()
    {
        
        // filter tanggal 
        $from   = Carbon::now()->subSeconds(1200)->format('Y/m/d H:i:s');
        $to     = Carbon::now()->subSeconds(65)->format('Y/m/d H:i:s');
        
        
        $speeds = LogNotifikasi::whereBetween('jam_trans',[$from,$to])
                    ->get();
        
        $labels = "Transaksi";
        
        $data   = $speeds->count('id');

        return response()->json(compact('labels', 'data'));
    }


    public function gettrans(Request $request)
    {
        
        $speeds = TabTransaksi::lates()->take(5)->get();
        
        $labels = 2;
        
        $data   = $speeds->count('tabtrans_id');

        return response()->json(compact('labels', 'data'));
    }

    


}
