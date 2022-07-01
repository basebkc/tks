<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kantor;
use App\Models\Tugas;
use GuzzleHttp\Client;
use Auth;
use DB;
use File;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;
use App\Exports\TugasExport;
use Maatwebsite\Excel\Facades\Excel;

class TksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        
    }
    public function index()
    {
        //

        $user      =  'Nana';//Auth::user();
        // dd($user);
        $menutks   = "active";
        $akses       = $user;
        // if($user->kode_kantor == '013'){
        //     $kantor = '000';
        // }else{
        //     $kantor = $user->kantor;
        // }
        try{
            $namakantor =   Kantor::where('KODE_KANTOR','000')->first();
        }catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        
        $namakantor = $namakantor->NAMA_KANTOR;
        $kantor     = Kantor::all();
        $tks        = 'active';
        return view('backend.tks.index',compact('akses','menutks','namakantor','tks','kantor'));
    }

    public function getHitungData(Request $request){

        $tanggal    = $request->tanggaltransaksi;
        $kodekantor = $request->kodekantor;
        $carahitung = $request->carahitung;
        
        $ldr        = $this->getApiLdr($tanggal,$kodekantor,$carahitung);


        return response('error',202);
    }


    public function getApiLdr($tanggal,$kodekantor,$carahitung){
        
        $headers = [
            'Content-Type' => 'application/json',
            'Accept'        => 'application/json'
        ];

        $body = [
            'tanggal' => $tanggal,
            'kodekantor' => $kodekantor,
            'carahitung' => $carahitung
        ];
        
        $client =  new Client();
      
        $response = $client->request('POST',env('APP_API').'api/getldr',[
            'form_params' => [
                $body
            ]
        ]);

        // dd($response);

        if ($response->getStatusCode() == 200) { 
            $response_data = $response->getBody()->getContents();
            
            $response_data = json_decode($response_data);
            
            $ldrdebit = 0;
            for($i=0;$i<count($response_data->data[0]);$i++){
                
                // if(preg_match("/10/i", $response_data->data[0][$i]->kode) && $response_data->data[0][$i]->kode != 100) {
                    // var_dump($response_data->data[0][$i]->kode);
                    // var_dump($response_data->data[0][$i]->saldoakhir);
                    // $ldrdebit  += $response_data->data[0][$i]->saldoakhir;
                // }   
                // dd($response_data->data[0][$i]);
                var_dump($response_data->data[0][$i]);
                var_dump("---");

                // DB::table('tks_ldr_trans')->insert([
                //     'kode'              => $response_data->data[0][$i]->kode,
                //     'nama_perkiraan'    => $response_data->data[0][$i]->nama_perkiraan,
                //     'jumlah'            => $response_data->data[0][$i]->saldoakhir,
                //     'kode_perk'         => $response_data->data[0][$i]->kode_perk,
                //     'cara_hitung'       => $carahitung,
                //     'tgl_trans'         => $tanggal,
                //     'tgl_hitung'        => date('Y-m-d'),
                //     'kode_kantor'       => $kodekantor
                // ]);
            }

            dd($ldrdebit);
           
            return Response::json(['OK'],200);
        }
    }
}
