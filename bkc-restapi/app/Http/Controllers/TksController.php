<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RodionARR\PDOService;
use Illuminate\Support\Facades\App;
use App\Models\Ldr;
use App\Models\LdrTrans;
use App\Models\Cr;
use App\Models\CrTrans;
use App\Models\Car;
use App\Models\CarTrans;


class TksController extends Controller
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

    public function resettks(Request $request){
       $cr      = CrTrans::where($request->all())->delete();
       $ldr     = LdrTrans::where($request->all())->delete();
       $car     = CarTrans::where($request->all())->delete();

       return response()->json([
            'data' => [
                'cr' => $cr,
                'ldr' => $ldr,
                'car'   => $car
            ],
            'status' => 200
        ]);
    }

}
