<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use App\Models\CarTrans;
use Validator;
use Carbon\Carbon;


class CarController extends Controller
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


    public function getCar(Request $request){ 
       
        $tanggal    = $request->tanggaltransaksi;
        $kodekantor = $request->kodekantor;
        $carahitung = $request->carahitung;

        $input = [
            'tgl_trans' => $tanggal,
            'kode_kantor' => $kodekantor,
            'cara_hitung' => $carahitung
        ];

        $data = CarTrans::where($input)->get();
        
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'kode'              => 'required|numeric',
            'nama_perkiraan'    => 'required|max:300',
            'jumlah'            => 'numeric',
            'kode_perk'         => 'required|numeric',
            'cara_hitung'       => 'numeric',
            // 'kode_kantor'       => 'required|numeric'
        ]);

        $saldoakhir = 1;

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $input = [
            'kode'              => $request->kode,
            'nama_perkiraan'    => $request->nama_perkiraan,
            'komponen'          => $request->komponen,
            'jumlah'            => $request->jumlah,
            'kode_perk'         => $request->kode_perk,
            'cara_hitung'       => $request->cara_hitung,
            'tgl_trans'         => $request->tgl_trans,
            'kode_kantor'       => $request->kode_kantor,
            'tgl_hitung'        => Carbon::now()
        ];
        

        $data = CarTrans::create($input);  
        
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }


    public function update(Request $request){
        $input = [
            'jumlah'            => $request->jumlah
        ];

        $data = CarTrans::where('id',$request->id)->update($input);
        
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

}
