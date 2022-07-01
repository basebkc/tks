<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TabTransaksi;

class NasabahController extends Controller
{
    

    // public function __construct(){

        // $this->middleware('auth:api', ['except' => ['login', 'register']]);

    // }

    public function index(){

        $data = TabTransaksi::orderBy('jam_trans','desc')
                ->limit(1)->first();

        $result = [
            'status' => 'OK',
            'message' => 'Data Transaksi Tabungan',
            'data' => $data
        ];       
             
        return response()->json($result,200);
    }
}
