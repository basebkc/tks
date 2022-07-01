<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TabTransaksi;
use App\Models\LogNotifikasi;
use App\Models\DaftarNasabahNotif;
use App\Models\MasterPesan;
use App\Models\Konfigurasi;

use Carbon\Carbon;
use DB;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('frontend.monitor.monitoring');
    }

    public function getnotif(){
		
		$result = 'Transaksi no rekening tidak terdaftar di notif whatapps.';
		// get data transaksi 5 menit ke belakang
        $dataServer = DB::connection('server')->select('call obox_getTabTrans(3)');
		
        foreach($dataServer as $datas){

            $cekDaftarNo = DaftarNasabahNotif::where('no_rekening',$datas->no_rekening)->first();
            // $cekDaftarNo = DaftarNasabahNotif::where('no_rekening','00120116534')->first();
            if($cekDaftarNo == null){
                $data = "Nasabah tidak terdaftar wa";

                $result = $data;
            }else{

                $cekStatusWa = LogNotifikasi::where('tabtrans_id', $datas->tabtrans_id)->first();
                if($cekStatusWa == null){
                    $norekening = $datas->no_rekening;
                    $nominal    = number_format($datas->pokok,2);
                    $tgltrans   = date('d/m/y H:i:s',strtotime($datas->jam_trans));
        
                    //enkripsi no rekening
                    $enkRekening = 'TB XXX'.substr($norekening, -3);
                    $parameter  = ['$norekening','$nominal','$tgltrans'];
                    $changeParam = [$enkRekening, $nominal, $tgltrans];
                    

                    //get master pesan 
                    $temp       = MasterPesan::where('kode_trans',$datas->kode_trans)->first();

                    //replace parameter di pesan ke nilai
                    $pesan      = str_replace($parameter, $changeParam,$temp->isi_pesan);
        
                    //kirim notifikasi by WhatApps
                    $data     = $this->notifWhatApps($cekDaftarNo->no_wa,$pesan);
                    
                    //simpan log pesan
                    $log = LogNotifikasi::create([
                        'no_rekening'   => $norekening,
                        'kode_trans'    => $datas->kode_trans,
                        'jenis_notif'   => "WhatApps",
                        'nominal'       => $nominal,
                        'jam_trans'     => $tgltrans,
                        'status_terkirim' => $data->original['message']['msg'],
                        'tabtrans_id'     => $datas->tabtrans_id,
                        'created_at'    => Carbon::now()
                    ]);

                    $result = json_decode($data, true);

                }else{
                    $data = "Sudah Terkirim";

                    $result = $data;
                }

            }
            // $this->cekDaftarNo($item->no_rekening);
            // $cekTabTrans = LogNotifikasi::where('tabtrans_id',$item->tabtrans_id)->first();
        
        }

        return response()->json(
            [
                'status' => TRUE,
                'message'   => $result
            ]);
    }
	
	public function getTabelCore(){
		
		// $data = DB::connection('server')->table('tabtrans as tt')
			// ->join(DB::connection('mysql')->table('bankbkc_backoffice.master_pesan as mp','mp.kode_trans','=','tt.KODE_TRANS')
		// ->whereIn('tt.kode_trans',[100,200,270,320])
		// ->whereBetween(
		// 'tt.jam_trans',[
			// Carbon::now()->subMinutes(3),Carbon::now()
			// ]
		// )
		// ->get();
		
		  // return response()->json(
                // [
                    // 'status' => TRUE,
                    // 'message'   => json_decode($data, true)
                // ]);
	}

    public function notifWhatApps($no,$message){
      
        
        $tempNo = substr($no,1);

        $get    = Konfigurasi::where('kode','101')->first();

        $chatApiToken = $get->isi;
        
        $number =  "62".$tempNo;

        $data = [
            'api_key' =>  $chatApiToken,
            'sender' => $get->nosender,
            'number' => $number,
            'message' => $message
        ];
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://wagateway.bankbkc.co.id/send-message",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json(
                [
                    'status' => TRUE,
                    'message'   => json_decode($response, true)
                ]);
    }

    public function getlognotif(){
        $data = LogNotifikasi::orderBy('created_at','desc')->limit(50)->get();
        
        $result = '';
        foreach($data as $item){
           
            $result .= '<span class="text-info">' . $item->jam_trans . '</span> 
                            <div class="my-1">No rekening <span class="text-info">' . $item->no_rekening . '</span>
                            Status ' . $item->status_terkirim . ' ( 
                            <span class="font-italic">' . $item->nominal .'</span> 
                            )';
                        '</div><br>';
            
        }

        

        return $result;

    }
}

