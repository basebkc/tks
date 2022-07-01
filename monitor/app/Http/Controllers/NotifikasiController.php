<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use DB;
use App\Models\DaftarNasabahNotif;
use App\Models\MasterPesan;
use App\Models\KodeTrans;
use App\Models\TabTransaksi;
use App\Models\LogNotifikasi;
use App\Models\Konfigurasi;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Response;
use Auth;
use App\Models\Kantor;


class NotifikasiController extends Controller
{

    private $authorization;
    
    public function __construct(Request $request){

        // $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->authorization = $request->header('Authorization');


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        
        $title      = "Log WhatApps Gateway";

        $akses   = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();
     
        $notiftab   = "active";
        $manaj      = "active";
		// $daftar = LogNotifikasi::latest()->get(); //select('id','no_rekening','kode_trans','created_at as waktu','status_terkirim')
        $daftar     = LogNotifikasi::join('daftar_nasabah_notif as d','d.no_rekening','=','log_notifikasi.no_rekening')
                        ->select('d.keterangan as nama','log_notifikasi.*')
                        ->orderBy('log_notifikasi.created_at','desc')
                        ->offset(0)
                        ->limit(10)
                        ->get();
        
                        
        return view('backend.notifikasi.notifikasinasabah',compact('notiftab','manaj','title','daftar','akses','namakantor'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->id == null){

            $ceknorekening      =  DaftarNasabahNotif::where('no_rekening',$request->no_rekening)
                                    ->first();

            if($ceknorekening){

                $result = [
                    'status' => 'failed',
                    'message' => 'No rekening sudah terdaftar, silakan dicek kembali.',
                ];

                return response()->json(
                    $result, 200
                );

            }

        }

       
        $input = [
            'kode_kantor'     => "001",
            'no_rekening'     => $request->no_rekening,
            'no_hp'           => $request->no_phone,
            'no_wa'           => $request->no_wa,
            'status_wa'       => $request->status_wa,
            'status_sms'      => $request->status_sms,
            'tgl_aktif'       => Carbon::now(),
            'tgl_akhir'       => Carbon::now()->addMonths(2),
            'keterangan'      => $request->keterangan,
            'created_at'      => Carbon::now()
        ];

        $data = DaftarNasabahNotif::updateOrCreate(
                    ['id' => $request->id],
                    $input    
                );
        if($data){
            $result = [
                'status' => 'success',
                'message' => $data,
            ];
        }else{
            $result = [
                'status' => 'failed',
                'message' => $data,
            ];
        }
      
          return response()->json(
                $result, 200
          );
    }

       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMaster(Request $request)
    {

        if($request->id == null){
           
            $masterpesan      =  MasterPesan::where(
                                    [
                                        'kode_trans'  => $request->kode,
                                    ])
                                    ->first();
        
            if($masterpesan){

                $result = [
                    'status' => 'failed',
                    'message' => 'kode Transaksi sudah dibuatkan, silakan dicek kembali.',
                ];

                return response()->json(
                    $result, 200
                );

            }

        }

       
        $input = [
            'kode_trans'      => $request->kode,
            'keterangan'      => $request->keterangan,
            'isi_pesan'       => $request->isi,
            'created_at'      => Carbon::now()
        ];
        

        $data = MasterPesan::updateOrCreate(
                    ['id' => $request->id],
                    $input    
                );

        if($data){
            $result = [
                'status' => 'success',
                'message' => $data,
            ];
        }else{
            $result = [
                'status' => 'failed',
                'message' => $data,
            ];
        }
      
          return response()->json(
                $result, 200
          );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data  = DaftarNasabahNotif::find($id);
        
        return response()->json([
            'data' => $data
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMaster($id)
    {
        $data  = MasterPesan::find($id);
        
        return response()->json([
            'data' => $data
        ]);
    }

    public function daftar(){
        
        $title      = "Pendaftaran Notifikasi Nasabah";
        $data       = DaftarNasabahNotif::orderBy('created_at','DESC')->get();
					
        $akses      = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();
        $daftarwa   = "active";
        $manaj      = "active";

        return view('backend.notifikasi.daftar',compact('manaj','daftarwa','title','data','akses','namakantor'));
    }

    public function listsms(){

        $title = "History Transaksi SMS";

        $akses   = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();

        $data   = DB::table('master_pesan')->orderBy('created_at','DESC')
                    ->get();

        $master   = "active";
        $manaj      = "active";
        $kodetrans  = KodeTrans::orderBy('kode_trans','ASC')->get();

        return view('backend.notifikasi.master',compact('master','manaj','title','data','kodetrans','akses','namakantor'));
    }

    public function sms($notujuan,$pesan){

        // Nexmo::message()->send([
        //     'to'   => '6281324418877',
        //     'from' => '6281313214547',
        //     'text' => 'test informasi di coba dari Bank BKC.'
        // ]);

        
            //init SMS gateway, look at android SMS gateway
            $idmesin="631";
            $pin="050005";

            $pesan = str_replace(" ","%20",$pesan);

            // create curl resource
            $ch = curl_init();

            // set url
            curl_setopt($ch, CURLOPT_URL, 'https://sms.indositus.com/sendsms.php?idmesin='.$idmesin.'&pin='.$pin.'&to='.$notujuan.'&text='.$pesan);

            //return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

            //setting agar bisa dijalankan dilocalhost
            // non aktifkan SSL (https)
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);


            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


            // $output contains the output string
            $output = curl_exec($ch);

            // close curl resource to free up system resources
            curl_close($ch);

            return $output;
            
        
    }

    // public function runsms(){

    //     $data = DB::table('daftar_nasabah_notif')->get();
    //     $ts     = [];
    //     foreach($data as $datas){

    //              $return = $this->sms($datas->no_hp,"test notifikasi sms from bank bkc. Thank");
    //                 $r ="";
    //             if($return == "success"){
    //                 $r ="Sms terkirim";
    //             }else{
    //                 $r ="Sms tidak terkirim";
    //             }

    //             array_push($ts,$r);
    //     }

    //     return $ts;

    //     // $return = $this->sms("6285221221100","test notifikasi sms from bank bkc. Thank");

    //     // if($return == "success"){
    //     //     return "<br>Sms terkirim";
    //     // }else{
    //     //     return "<br>Sms tidak terkirim";
    //     // }
    // }

    public function getdata(){
        $data =     TabTransaksi::with('MasterPesan')
                    ->where('kode_trans','=','100')
                    ->limit(5)
                    ->get();
                    // DB::Connection('server')->table('tabtrans')
                    // ->join(
                    //         DB::Connection('mysql')
                    //         ->table('master_pesan','tabtrans.KODE_TRANS','=','master_pesan.kode_trans')
                    //     )
                    // ->limit(10)
                    // ->get();
                    // join('master_pesan as m','m.kode_trans','=','tabtrans.kode_trans')
                    // ->join('daftar_nasabah_notif as d','d.no_rekening','=','tabtrans.NO_REKENING')
                    // ->whereBetween('tabtrans.jam_trans',['2021-08-30 16:25:00','2021-08-30 16:26:00'])
                    // ->orderBy('tabtrans.tabtrans_id','DESC')
                    // ->get();
        
        return $data;
    }

    public function runwhatapps(){

        // filter tanggal 
        $current_date   = Carbon::now()->subSeconds(65);

        $until_date     = Carbon::now()->subSeconds(5);

        $from   = date('Y-m-d H:i:s',strtotime($current_date));
        $to     = date('Y-m-d H:i:s',strtotime($until_date));

        //ambil data by filter tanggal
        $data =     TabTransaksi::join('master_pesan as m','m.kode_trans','=','tabtrans.kode_trans')
                    ->join('daftar_nasabah_notif as d','d.no_rekening','=','tabtrans.NO_REKENING')
                    ->whereBetween('tabtrans.jam_trans',[$from,$to])
                    ->where('d.status_wa','on')
                    ->orderBy('tabtrans.tabtrans_id','DESC')
                    ->get();
         
        // $norekening = NULL;
        // $nominal    = NULL;
        // $tgltrans   = NULL;
        // $enkRekening = NULL;
        // $changeParam = NULL;
        // $pesan      = NULL;
        // $parameter  = NULL;

        
        $result     = NULL;
       
        if(count($data) > 1 ){

            foreach($data as $datas){

                $norekening = $datas->no_rekening;
                $nominal    = number_format($datas->POKOK,2);
                $tgltrans   = date('d/m/y H:i:s',strtotime($datas->jam_trans));
    
                //enkripsi no rekening
                $enkRekening = 'TB XXX'.substr($norekening, -3);
                $parameter  = ['$norekening','$nominal','$tgltrans'];
                
                $changeParam = [$enkRekening, $nominal, $tgltrans];
    
                //replace parameter di pesan ke nilai
                $pesan      = str_replace($parameter, $changeParam,$datas->isi_pesan);
    
                //kirim notifikasi by WhatApps
                $result     = $this->notifWhatApps($datas->no_wa,$pesan);
                
                //simpan log pesan
                $log = LogNotifikasi::create([
                    'no_rekening'   => $norekening,
                    'kode_trans'    => $datas->kode_trans,
                    'jenis_notif'   => "WhatApps",
                    'nominal'       => $nominal,
                    'jam_trans'     => $tgltrans,
                    'status_terkirim' => $result,
                    'created_at'    => Carbon::now()
                ]);
                
            }

        }else{
            
            $norekening = $data->no_rekening;
            $nominal    = number_format($data->POKOK,2);
            $tgltrans   = date('d/m/y H:i:s',strtotime($data->jam_trans));

            //enkripsi no rekening
            $enkRekening = 'TB XXX'.substr($norekening, -3);
            $parameter  = ['$norekening','$nominal','$tgltrans'];
            
            $changeParam = [$enkRekening, $nominal, $tgltrans];

            //replace parameter di pesan ke nilai
            $pesan      = str_replace($parameter, $changeParam,$data->isi_pesan);

            //kirim notifikasi by WhatApps
            $result     = $this->notifWhatApps($data->no_wa,$pesan);
            
            //simpan log pesan
            $log = LogNotifikasi::create([
                'no_rekening'   => $norekening,
                'kode_trans'    => $data->kode_trans,
                'jenis_notif'   => "WhatApps",
                'nominal'       => $nominal,
                'jam_trans'     => $tgltrans,
                'status_terkirim' => $result,
                'created_at'    => Carbon::now()
            ]);
            // dd($log);
        }

        
        return response()->json([
            'notifikasi'    => $result,
            'message'       => $data,
            'log'           => $log
        ],200);
        

    }


    // NOTIFICATION WHATAPPS TAB TRANSAKSI
    public function notifWhatApps($no,$message){

        // Pastikan phone menggunakan kode negara atau
        // 62 di depannya untuk Indonesia atau
        // bisa menggunakan 0 jika nomor tujuan Indonesia

        $tempNo = substr($no,1);

        $get    = Konfigurasi::where('kode','101')->first();

        $chatApiToken = $get->isi;
        
        $number =  "62".$tempNo;
        // $message = "Terima kasih". "\n";
        // $message .= " Sudah mengajukan kredit di Perumda Bank BPR Kabupaten Cirebon (Bank BKC) ";
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://chat-api.phphive.info/message/send/text',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode(array("jid"=> $number."@s.whatsapp.net", "message" => $message)),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$chatApiToken,
            'Content-Type: application/json'
        ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        return $response;

    }

    // simulasi transaksi tabungan
    public function exampleTransaksiTabungan(Request $request){

        $data = [
            'api_key' =>  'rK9Mr1lu6tAbc5h8OcxybjqLB9DW2M',
            'sender' => '6285161213574',
            'number' => '62817629601',
            'message' => 'Hallo test test wa banking '
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://wagateway.bankbkc.co.id/send-message',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json'
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


    // get tabel tabtrans
    public function getDataTabTransaksi(){

        $client = new Client;

        $headers = [
            'Content-Type' => 'application/json',
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' //$authorization
        ];


        $response = $client->GET(env('APP_URL').'/api/auth/nasabah', [
            'headers' => $headers,
           
        ]);

        if ($response->getStatusCode() == 200) { // 200 

            $response_data = $response->getBody()->getContents();
            $datajson = json_decode($response_data);

            // save process send notification
            $this->storeTabTransNotif($datajson->data);

            // return Response::json(json_decode($response_data));
        }

    }

    // save tab transaksi notif
    public function storeTabTransNotif($datajson){

        
        $tempdatanasabah =  DaftarNasabahNotif::where('no_rekening',$datajson->NO_REKENING)->first();

        $datanasabah = json_decode($tempdatanasabah);
        
        $norekening = $datanasabah->no_rekening;
        
        $nominal    = number_format($datajson->POKOK,2);
        $tgltrans   = date('d/m/y H:i:s',strtotime($datajson->jam_trans));

        //enkripsi no rekening
        $enkRekening = 'TB XXX'.substr($norekening, -3);
        $parameter   = ['$norekening','$nominal','$tgltrans'];
        $changeParam = [$enkRekening, $nominal, $tgltrans];

        //get master pesan 
        $temp       = MasterPesan::where('kode_trans',$datajson->KODE_TRANS)->first();

        //replace parameter di pesan ke nilai
        $pesan      = str_replace($parameter, $changeParam,$temp->isi_pesan);

        //kirim notifikasi by WhatApps
        $result     = $this->notifWhatApps($datanasabah->no_wa,$pesan);

        
        $status_pesan = json_decode($result);
       
        //simpan log pesan
        $log = LogNotifikasi::create([
            'no_rekening'   => $norekening,
            'kode_trans'    => $temp->kode_trans,
            'jenis_notif'   => "WhatApps",
            'nominal'       => $nominal,
            'jam_trans'     => $tgltrans,
            'status_terkirim' =>  $status_pesan->error,
            'created_at'    => Carbon::now()
        ]);

        $response_data = [
            'status' => 'OK',
            'message' => 'Berhasil disimpan'
        ];
        
        return Response::json($response_data,200);


    }

    //get show Log Tab Transaksi Notifikasi
    public function getDataLogTabTrans(Request $request){

        $data = LogNotifikasi::select('id','no_rekening','kode_trans','created_at as waktu','status_terkirim')
                ->orderBy('created_at','DESC')->paginate(5);
        // dd($data);
        return  $data;//Response::json($data,200);

    }

    

    
}
