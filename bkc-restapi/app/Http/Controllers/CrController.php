<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use App\Models\CrTrans;
use App\Models\Cr;
use Validator;
use Carbon\Carbon;


class CrController extends Controller
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


    public function getCr(Request $request){ 
       
        $tanggal    = $request->tanggaltransaksi;
        $kodekantor = $request->kodekantor;
        $carahitung = $request->carahitung;

        $input = [
            'tgl_trans' => $tanggal,
            'kode_kantor' => $kodekantor,
            'cara_hitung' => $carahitung
        ];

        $data = CrTrans::where($input)->orderBy('kode','asc')->get();
        
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
                'cara_hitung'       => 'numeric'
                //'kode_kantor'       => 'required|numeric'
            ]);
    
            $saldoakhir = 1;
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $input = [
                'kode'              => $request->kode,
                'nama_perkiraan'    => $request->nama_perkiraan,
                'jumlah'            => $request->jumlah,
                'kode_perk'         => $request->kode_perk,
                'cara_hitung'       => $request->cara_hitung,
                'tgl_trans'         => $request->tgl_trans,
                'kode_kantor'       => $request->kode_kantor,
                'tgl_hitung'       => Carbon::now()
            ];
            
            $data = CrTrans::create($input);
        
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

    public function update(Request $request){
           
        $input = [
            'jumlah'            => $request->jumlah
        ];
        
        // var_dump($input);

        $data = CrTrans::where('id',$request->id)->update($input);
        
        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

}
