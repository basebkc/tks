<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Kantor;
use App\Models\Tugas;
use Auth;
use DB;
use File;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;
use App\Exports\TugasExport;
use Maatwebsite\Excel\Facades\Excel;

class TugasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $akses      = Auth::user();
        $user       = $akses->name;
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();

        if($akses->role_id == 1){
            $data = DB::table('tugas as t')->join('tbl_kantor as k','t.cabang','=','k.kd_kan')
                ->leftJoin('kategori_tugas as kt','kt.id','=','t.kategori')
                ->select('t.*','kt.kategori as namakategori','k.n_kan')
                ->orderBy('t.created_at','DESC')->get();
        }else{
            $data = DB::table('tugas as t')->join('tbl_kantor as k','t.cabang','=','k.kd_kan')
                ->leftJoin('kategori_tugas as kt','kt.id','=','t.kategori')
                ->leftJoin('users as  u','u.id','=','t.user_id')
                ->where('u.id',$akses)
                ->select('t.*','kt.kategori as namakategori','k.n_kan')
                ->orderBy('t.created_at','DESC')->get();
        }
      
        $tugas = "active open";
        $kantor = Kantor::all();
        $kategori = DB::table('kategori_tugas')->get();
        return view('backend.tugas.table', compact('kategori','tugas','akses','namakantor','kantor','user','data'));
    }

    public function store(Request $request){

       
        if($request->id){
            
            if($request->file('lampiran')){
              
                $exttenk = $request->lampiran->getClientOriginalExtension();
               
                if($exttenk == "jpg" || 
                    $exttenk == "png" || 
                    $exttenk == "jpeg" || 
                    $exttenk == "pdf" ||
                    $exttenk == "JPG" || 
                    $exttenk == "PNG" || 
                    $exttenk == "JPEG")
                {
                    
                    $imagePathktp = $request->file('lampiran');
                   
                    $imageNamektp = Carbon::now()->format('YmdHi').$imagePathktp->getClientOriginalName();
                    $pathktp = $request->file('lampiran')->storeAs('/uploads/lampiran', $imageNamektp, 'public');
                   
                   
                    $input = [
                        'lampiran' => $imageNamektp,
                        'status' => $request->status,
                        'keterangan_selesai' =>  $request->ketselesai,
                        'sifat' => $request->sifat,
                        'kategori' => $request->kategori,
                        'updated_at' => Carbon::now(),
                        'PIC_IT' => $request->PIC_IT,
                        'tanggal_selesai' => date("Y-m-d",strtotime($request->selesaiwaktu)),
                    ];
                    DB::table('tracking_tugas')->insert([
                        'nopengajuantugas' => $request->nopengajuantugas,
                        'status'            => $request->status , //progress
                        'created_at'        => Carbon::now()
                    ]);
                }else{
                    $result = response()->json(
                        [
                            'data'    => "maaf, harus format image atau foto.",
                            'message' => 'bad request'
                        ],200
                       
                    );

                  
                }
              
            }else{
                $input = [
                    'lampiran' => null,
                    'status' => $request->status,
                    'keterangan_selesai' =>  $request->ketselesai,
                    'sifat' => $request->sifat,
                    'kategori' => $request->kategori,
                    'updated_at' => Carbon::now(),
                    'PIC_IT' => $request->PIC_IT,
                    'tanggal_selesai' => date("Y-m-d",strtotime($request->selesaiwaktu)),
                ];

                DB::table('tracking_tugas')->insert([
                    'nopengajuantugas' => $request->nopengajuantugas,
                    'status'            => $request->status , //progress
                    'created_at'        => Carbon::now()
                ]);
            }
         
            
        }else{
            
            $generateTiket = $this->generateNoTiket($request->cabang);
          
            $input = [
                'nopengajuantugas' => $generateTiket,
                'status'            => '0' , //progress
                'cabang'   => $request->cabang,
                'PIC_cabang' => $request->pic_cabang,
                'kendala' => $request->kendala,
                'keterangan' => $request->keterangan,
                'kontak' => $request->kontak,
                'remote' => $request->remote,
                'created_at' => Carbon::now(),
            ];

            DB::table('tracking_tugas')->insert([
                'nopengajuantugas' => $generateTiket,
                'status'            => '0' , //progress
                'created_at'        => Carbon::now()
            ]);
        }

     
       
        $result = Tugas::updateOrCreate(['id' => $request->id],$input);
        
        return response()->json([
            'data' => $result
        ]);
    }

    public function getData($id){

        $data = DB::table('tugas')->where('id',$id)->first();
       
        return response()->json([
            'data' => $data
        ]);
    }

    public function displayImage($filename)
    {

        $path = storage_public('uploads/lampiran/' . $filename);

        if (!File::exists($path)) {

            abort(404);

        }
    
        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;

    }

    public function cetak(Request $request){
        
        $tgl1 =  $request->daritanggal;
        $tgl2 =  $request->sampaitanggal;
        $data = Tugas::join('tbl_kantor as cbg','cbg.kd_kan','=','tugas.cabang')
                    ->leftJoin('kategori_tugas as kt','kt.id','=','tugas.kategori')
                    ->select('tugas.*','kt.kategori as namakategori','cbg.n_kan')
                    ->whereBetween('tugas.created_at',[$tgl1,$tgl2])
                    ->orderBy('tugas.created_at','DESC')->get();
      
        
        $pdf = PDF::loadview('backend.tugas.rptTugas',['data'=>$data,'daritgl' => $tgl1, 'sampaitgl' => $tgl2])->setOptions(['defaultFont' => 'sans-serif'])
                ->setPaper('a4', 'landscape');;
        return $pdf->download('laporan-pegawai-pdf');

    }

    public function print(Request $request){
        $tgl1 =  $request->daritanggal;
        $tgl2 =  $request->sampaitanggal;
      
        return Excel::download(new TugasExport($tgl1,$tgl2), 'TugasLaporan.xlsx');
    }

    public function generateNoTiket($cabang){
        
        return $cabang.date("Ymdhis");

    }

    public function tracking(){
        $akses      = Auth::user();
        $user       = $akses->name;
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();

        $data = DB::table('tracking_tugas')
                    ->orderBy('nopengajuantugas','DESC')
                    ->orderBy('created_at','DESC')
                    ->get();
      
        $tugastrack = "active open";
        $kantor = Kantor::all();
        $kategori = DB::table('kategori_tugas')->get();
        return view('backend.tugas.tabletracking', compact('kategori','tugastrack','akses','namakantor','kantor','user','data'));
    }
}
