<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use App\Models\Ldr;
use App\Models\Cr;
use DB;


class TransTksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function gettransCr(Request $request){ 
       
        $tanggal    = $request->tanggaltransaksi;
        $kodekantor = $request->kodekantor;
        $carahitung = $request->carahitung;
       
        $service = App::make(PDOService::class);
        $multipleRowsets = $service->callStoredProcedure('getTksCashRatio', [$tanggal, $kodekantor, $carahitung]);
        
        return response()->json([
            'data' => $multipleRowsets,
            'status' => 200
        ]);
    }

    public function gettransLdr(Request $request){ 
       
        $tanggal    = $request->tanggaltransaksi;
        $kodekantor = $request->kodekantor;
        $carahitung = $request->carahitung;
       
        $service = App::make(PDOService::class);
        $multipleRowsets = $service->callStoredProcedure('getTksLdr', [$tanggal, $kodekantor, $carahitung]);
        
        return response()->json([
            'data' => $multipleRowsets,
            'status' => 200
        ]);
    }


    public function gettransCar(Request $request){ 
       
        $tanggal    = $request->tanggaltransaksi;
        $kodekantor = $request->kodekantor;
        $carahitung = $request->carahitung;
       
        $service = App::make(PDOService::class);
        $multipleRowsets = $service->callStoredProcedure('getTksCar', [$tanggal, $kodekantor, $carahitung]);
        
        return response()->json([
            'data' => $multipleRowsets,
            'status' => 200
        ]);
    }


    public function getDataLdr(){

        $data = Ldr::all();
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

    
    public function getDataCr(){

        $data = Cr::all();
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

    

}
