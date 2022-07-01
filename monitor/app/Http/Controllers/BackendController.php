<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Agunan;
use App\Models\ContentUtama;
use App\Models\Dashboard;
use App\Models\Sukubunga;
use App\Models\Nasabah;
use App\Models\Kantor;
use App\Models\NasabahBaru;
use App\Models\NasabahKredit;
use App\Models\KabupatenKota;
use App\Models\Pekerjaan;
use Carbon\Carbon;
use WordTemplate;
use Auth;
use DB;
use File;
use ZipArchive;
use \PhpOffice\PhpWord\TemplateProcessor,
    \PhpOffice\PhpWord\Shared\Html,
    \PhpOffice\PhpWord\PhpWord;



use Datatables;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        
        $akses      = Auth::user();
        $user       = $akses->name;
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();

        $jabatan  = "Staff IT";
        $title = "Dasboard";
        $dashboard = "active open";
        
        return view('backend.home', compact('dashboard','title','akses','namakantor','user','jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $akses      = Auth::user();
        $user       = $akses->name;
        $kabupatenkota      = KabupatenKota::all();
        $pekerjaan          = Pekerjaan::all();
        $cabang             = Kantor::where('kd_kan',$akses->kode_kantor)->first();
        $jenis_penggunaan   = DB::table('kre_kode_jenis_penggunaan')->get();
        $namakantor         = Kantor::where('kd_kan',$akses->kode_kantor)->first();
        return view('backend.kredit.create',compact('pekerjaan','namakantor','cabang','jenis_penggunaan','kabupatenkota','akses','user'));
        
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeKredit(Request $request)
    {
        
        $this->validate($request,[
                    "nik"   => "required",
                    "masaberlaku" => "required",
                    "nama" => "required",
                    "alias" => "required",
                    "tempatlahir" => "required",
                    "tgllahir" => "required",
                    "kewarganegaraan" => "required",
                    "negara" => "required",
                    "jeniskelamin" => "required",
                    "status" => "required",
                    "agama" => "required",
                    // "npwp" => "required",
                    "alamat" => "required",
                    "kota" => "required",
                    "kodepos" => "required",
                    "tlpn" => "required",
                    "nohp" => "required",
                    "pendidikan" => "required",
                    "jmltanggungan" => "required",
                    "pekerjaan" => "required",
                    "jabatan" => "required",
                    "perusahaan" => "required",
                    "alamatperusahaan" => "required",
                    "kotaperusahaan" => "required",
                    "kodeposperusahaan" => "required",
                    "namasuamiistri" => "required",
                    "namaibukandung" => "required",
                    "nikpasangan" => "required",
                    "tgllahirpasangan" => "required",
                    "tlpnsuamiistri" => "required",
                    "nosuamiistri" => "required",
                ]);

        $input = [
            'namalengkap' => $request->nama, 
            'permohonan' => "",
            'jaminan' => "", 
            'nilaidiajukan' => "",
            'jangkawaktu' => "",
            'tujuankredit' => "",
            'nik' => $request->nik, 
            'telepon' => $request->tlpn, 
            'hp' => $request->nohp, 
            'pekerjaan' => $request->pekerjaan,
            'email' => $request->email, 
            'alamat' => $request->alamat,
            'pathktp' => "",
            'pathkk' => "", 
            'pathsuratjaminan' => "",
            'masaberlaku' => date('Y-m-d', strtotime($request->masaberlaku)),
            'namaalias' => $request->alias, 
            'tempatlahir' => $request->tempatlahir, 
            'kewarganegaraan' => $request->kewarganegaraan, 
            'negara' => $request->negara, 
            'jk' => $request->jeniskelamin, 
            'status' => $request->status, 
            'agama' => $request->agama, 
            'npwp' => $request->npwp, 
            'kota' => $request->kota, 
            'kodepos' => $request->kodepos, 
            'pendidikan' => $request->pendidikan, 
            'jmlhtanggungan' => $request->jmltanggungan, 
            'jabatan' => $request->jabatan, 
            'perusahaan' => $request->perusahaan, 
            'alamatperusahaan' => $request->alamatperusahaan, 
            'kotaperusahaan' => $request->kotaperusahaan, 
            'kodeposperusahaan' => $request->kodeposperusahaan, 
            'namasuamiistri' => $request->namasuamiistri, 
            'namaibukandung' => $request->namaibukandung, 
            'teleponsaudara' => $request->tlpnsuamiistri, 
            'hpsaudara' => $request->nosuamiistri, 
            'kettujuankredit' => $request->kettujuankredit, 
            'cabang' => $request->cabang, 
            'nikpasangan' => $request->nikpasangan,
            'nopengajuan' => '',
            'email' => $request->email,
            'tgllahir' => date('Y-m-d', strtotime($request->tgllahir)),
            'tgllahirpasangan' => date('Y-m-d', strtotime($request->tgllahirpasangan)),
            'proses_pengajuan' => 'pending',
        ];

        // dd($input);die; 

        $result = Nasabahkredit::create($input);

        return Response()->json(['message' => $result,'status' => 200]);
                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       
        $generateslik1              = "";
        $generateslik2              = "";
        $nopengajuan                = "";


        // CHECK VALIDATION STEP 1
        if($request->step == "1"){
            $this->validate($request,[
              
                'nik'           => 'required',
                'masaberlaku'   => 'required',
                'nama'          => 'required',
                'alias'         => 'required',
                'tempatlahir'   => 'required',
                'tgllahir'      => 'required',
                'kewarganegaraan' => 'required',
                'jeniskelamin'  => 'required',
                'agama'         => 'required',
                // 'npwp'          => 'required',
                'alamat'        => 'required',
                'kota'          => 'required',
                'kodepos'       => 'required',
                'tlpn'          => 'required',
                'nohp'          => 'required',
                'pendidikan'    => 'required',
                'pekerjaan'     => 'required',
                'jmltanggungan' => 'required',
                'jabatan'       => 'required',
                'perusahaan'    => 'required',
                'alamatperusahaan'      => 'required',
                'kotaperusahaan'        => 'required',
                'kodeposperusahaan'     => 'required:max:6',
                'namasuamiistri'        => 'required',
                'namaibukandung'        => 'required',
                'tlpnsuamiistri'        => 'required',
                'nikpasangan'           => 'required',
                'tgllahirpasangan'      => 'required',
                'nohp'                  => 'required'
                
             ]);
             
        }else

        // CHECK VALIDATION STEP 2
        if($request->step == "2"){
            $this->validate($request,[
              
                'permohonan'        => 'required',
                'tglpengajuan'      => 'required',
                'nilaidiajukan'     => 'required',
                'jangkawaktu'       => 'required',
                'tujuankredit'      => 'required',
                'cabang'            => 'required',
                'kettujuankredit'   => 'required',
                
                
             ]);
        }

      
        //STEP 3
        if($request->step == "3"){

            // $imageNamektp               = "";        
            // $imageNamekk                = "";
            // $imageNamektppasangan       = "";
            // $imageNamesuratjaminan      = "";
            
            // if($request->file('ktp')){
            //     $imagePathktp = $request->file('ktp');
               
            //     // GIVE NAME FILE
            //     $imageNamektp = Carbon::now()->format('YmdHi').$imagePathktp->getClientOriginalName();
                
            //     // UPLOAD IMAGE
            //     $pathktp = $request->file('ktp')->storeAs('/uploads/ktp', $imageNamektp, 'public');
            // }

            // if($request->file('kk')){
            //     $imagePathkk = $request->file('kk');

            //     // GIVE NAME FILE
            //     $imageNamekk = Carbon::now()->format('YmdHi').$imagePathkk->getClientOriginalName();
                
            //     // UPLOAD IMAGE
            //     $pathkk = $request->file('kk')->storeAs('/uploads/kk', $imageNamekk, 'public');
              
            // }
          
            // if($request->file('ktppasangan')){
            //     $imagePathktppasangan = $request->file('ktppasangan');

            //     // GIVE NAME FILE
            //     $imageNamektppasangan = Carbon::now()->format('YmdHi').$imagePathktppasangan->getClientOriginalName();
                
            //     // UPLOAD IMAGE
            //     $pathktppasangan = $request->file('ktppasangan')->storeAs('/uploads/ktppasangan', $imageNamektppasangan, 'public');
              
            // }

            // if($request->file('suratjaminan')){
            //     $imagePathsuratjaminan = $request->file('suratjaminan');

            //     // GIVE NAME FILE
            //     $imageNamesuratjaminan = Carbon::now()->format('YmdHi').$imagePathsuratjaminan->getClientOriginalName();
                
            //     // UPLOAD IMAGE
            //     $pathsuratjaminan = $request->file('suratjaminan')->storeAs('uploads/suratjaminan', $imageNamesuratjaminan, 'public');
            
            // }
            
            // // SAVING FILE NAME 
            // $update = [
            //     'pathktp'               => $imageNamektp,
            //     'pathkk'                => $imageNamekk,
            //     'pathktppasangan'       => $imageNamektppasangan,
            //     'pathsuratjaminan'      => $imageNamesuratjaminan,
            //     'proses_pengajuan'      => 'proses'
            // ];

           

            $result = Nasabahkredit::where('id',$request->id)->update('proses_pengajuan','2');

            if($result == 1){
                $data = Nasabahkredit::where('id',$request->id)->first();
                $info = 'success';
            }else{
                $data = Nasabahkredit::where('id',$request->id)->first();
                $info = 'failed';
            }

            return Response()->json(['data'=>$data, 'message' => $result,'info' => $info,'status' => 200]);

        }

        //STEP 4
        if($request->step == "4"){

            $result = Nasabahkredit::where('id',$request->id)->update('proses_pengajuan','3');

            if($result == 1){
                $data = Nasabahkredit::where('id',$request->id)->first();
                $info = 'success';
            }else{
                $data = Nasabahkredit::where('id',$request->id)->first();
                $info = 'failed';
            }

            return Response()->json(['data'=>$data, 'message' => $result,'info' => $info,'status' => 200]);

        }

        $data = Nasabahkredit::where('id',$request->id)->first();
       
        if(isset($request->alamat)){ $alamat = $request->alamat; }else{ $alamat = $data->alamat; }

        if(isset($request->status)){ $status = $request->status; }else{ $status = $data->status; }
        
        if(isset($request->pekerjaan)){ $pekerjaan = $request->pekerjaan; }else{  $pekerjaan = $data->pekerjaan;   }

        if(isset($request->negara)){ $negara = $request->negara; }else{ $negara = $data->negara; }
        
        if(isset($request->kewarganegaraan)){ $kewarganegaraan = $request->kewarganegaraan; }else{ $kewarganegaraan = $data->kewarganegaraan; }
            
        if(isset($request->kodepos)){ $kodepos = $request->kodepos; }else{ $kodepos = $data->npwp; }
        
        if(isset($request->pendidikan)){ $pendidikan = $request->pendidikan; }else{ $pendidikan = $data->pendidikan; }

        //generate slik
        if($request->step == "2"){

            $parameter      = [
                "nik1"          => $request->nik,
                "nik2"          => $request->nikpasangan,
                "tglpengajuan"  => $request->tglpengajuan,
                "cabang"        => $request->cabang,
                "tgllahir"      => $request->tgllahir,
                "tgllahirpas"   => $request->tgllahirpasangan,
                "id"            => $request->id
            ];
        

            $result  = $this->generateSlikDanNoPengajuan($parameter);

            $generateslik1  = $result['slik1'];
            $generateslik2  = $result['slik2'];
            $nopengajuan    = $result['nopengajuan'];
            $status_pengajuan = "1"; //status pending

        }
            
        $checkdata = NasabahKredit::where('id',$request->id)->first();
            
        //check data on local 
        if($checkdata == null){
            
            $array = [ 
                        'id' => $request->id,
                        'nopengajuan' => '',
                        'proses_pengajuan'  => "1"  //status pending
                    ];
            $datepengajuan = Carbon::now()->format('Y-m-d');
        }else{
            $array = $checkdata->id;
            $datepengajuan = $checkdata->tglpengajuan;
        }

        $input = [
            'nopengajuan'           => $nopengajuan,
            'nik'                   => $request->nik,
            'nogenerateslik1'       => $generateslik1,
            'nogenerateslik2'       => $generateslik2,
            'masaberlaku'           => date('Y-m-d', strtotime($request->masaberlaku)),
            'namalengkap'           => $request->nama,
            'namaalias'             => $request->alias,
            'tempatlahir'           => $request->tempatlahir,
            'tgllahir'              => date('Y-m-d', strtotime($request->tgllahir)),
            'kewarganegaraan'       => $kewarganegaraan,
            'negara'                => $negara,
            'jk'                    => $request->jeniskelamin,
            'agama'                 => $request->agama,
            'status'                => $status,
            'npwp'                  => $request->npwp,
            'alamat'                => $request->alamat,
            'kota'                  => $request->kota,
            'kodepos'               => $request->kodepos,
            'telepon'               => $request->tlpn,
            'hp'                    => $request->nohp,
            'pendidikan'            => $pendidikan,
            'pekerjaan'             => $pekerjaan,
            'email'                 => $request->email,
            'jaminan'               => $request->jaminan,
            'jmlhtanggungan'        => $request->jmltanggungan,
            'jabatan'               => $request->jabatan,
            'perusahaan'            => $request->perusahaan,
            'alamatperusahaan'      => $request->alamatperusahaan,
            'kotaperusahaan'        => $request->kotaperusahaan,
            'kodeposperusahaan'     => $request->kodeposperusahaan,
            'namasuamiistri'        => $request->namasuamiistri,
            'namaibukandung'        => $request->namaibukandung,
            'teleponsaudara'        => $request->tlpnsuamiistri,
            'hpsaudara'             => $request->nosuamiistri,
            'permohonan'            => $request->permohonan,
            'nilaidiajukan'         => $request->nilaidiajukan,
            'jangkawaktu'           => $request->jangkawaktu,
            'tujuankredit'          => $request->tujuankredit,
            'cabang'                => $request->cabang,
            'nikpasangan'           => $request->nikpasangan,
            'tgllahirpasangan'      => date('Y-m-d', strtotime($request->tgllahirpasangan)),
            'kettujuankredit'       => $request->kettujuankredit,
            'created_at'            => Carbon::now(),
            'tglpengajuan'          => $datepengajuan,
            'proses_pengajuan'      => "1" //status pending
        ];

        //check data to update or create 
        if($checkdata == null){
            $arr = array_merge($input,$array);
            
            $result = Nasabahkredit::create($arr);    
                
        }else{
            $result = Nasabahkredit::where('id',$array)->update($input);   
        }

            
        if($result){
            $info = 'success';
        }else{
            $info = 'failed';
        }

        return Response()->json(['id' => $request->id,'message' => $result,'info' => $info,'status' => 200]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $title = "Detail Info";
        $user       = Auth::user()->name;
        
        $jabatan    = "Staff IT";
        return view('backend.nasabahkredit.edit.edit',compact('title','user','jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // content slider 
    public function contentutama(){
        
        if(request()->ajax()) {
            return datatables()->of(ContentUtama::select('*'))
            ->addColumn('Aksi', 'backend.contentutama.edit')
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->make(true);
        }
       return view('backend.contentutama.list');
    }

    public function storecontentutama(Request $request){
        $companyId = $request->id;

        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $name = $request->file('image')->getClientOriginalName();
       
        $path = $request->file('image')->store('public/images');
        
        $company   =   ContentUtama::updateOrCreate(
                    [
                     'id' => $companyId
                    ],
                    [
                    'judul' => $request->name, 
                    'isi' => $request->email,
                    'catatankecil' => $request->address,
                    'button' => $request->address,
                    'url' => $request->address,
                    'namagambar' => $request->address,
                    'path' => $request->address
                    ]);    
                         
        return Response()->json($company);
    }

    public function editcontentutama(Request $request){
        $where = array('id' => $request->id);
        $content  = ContentUtama::where($where)->first();
      
        return Response()->json($content);
    }

    public function deletecontentutama(Request $request){
        $company = ContentUtama::where('id',$request->id)->delete();
      
        return Response()->json($company);
    }


    // dashboard

    public function dashboard(){
        
        if(request()->ajax()) {
            return datatables()->of(Dashboard::select('*'))
            ->addColumn('Aksi', 'backend.dashboard.edit')
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->make(true);
        }
       return view('backend.dashboard.list',
                    ['title' => 'Dashboard']
                );
    }

    public function storedashboard(Request $request){
        $companyId = $request->id;

        
        $company   =   ContentUtama::updateOrCreate(
                    [
                     'id' => $companyId
                    ],
                    [
                    'judul' => $request->name, 
                    'isi' => $request->email,
                    'catatankecil' => $request->address,
                    'button' => $request->address,
                    'url' => $request->address,
                    'namagambar' => $request->address,
                    'path' => $request->address
                    ]);    
                         
        return Response()->json($company);
    }

    public function editdashboard(Request $request){
        $where = array('id' => $request->id);
        $content  = ContentUtama::where($where)->first();
      
        return Response()->json($content);
    }

    // suku bunga

    public function sukubunga(){
        
        if(request()->ajax()) {
            return datatables()->of(Sukubunga::select('*'))
            ->addColumn('Aksi', 'backend.sukubunga.edit')
            ->rawColumns(['Aksi'])
            ->addIndexColumn()
            ->make(true);
        }
       return view('backend.sukubunga.list',
                ['title' => 'Suku Bunga']
            );
    }

    public function storesukubunga(Request $request){

        $id         = $request->id;
        $username   = User::first();
        
        $company    =   Sukubunga::updateOrCreate(
                        [
                        'id' => $id
                        ],
                        [
                            'jenis_produk' => $request->jenis, 
                            'nama_produk' => $request->produk,
                            'suku_bunga' => $request->sukubunga,
                            'update_by' => $username->name,
                            'created_at' => Carbon::now(),    
                            'updated_at' => Carbon::now()    
                        ]
                    );    
                    
                         
        return Response()->json($company);
    }

    public function editsukubunga(Request $request){
        $where = array('id' => $request->id);
        $content  = Sukubunga::where($where)->first();
        
        return Response()->json($content);
    }


    //  Download Dokument Data Permohonan
    public function createDoc($id) {
        
        
        $data   = DB::table('nasabah_kredits as a')
                    ->selectRaw('a.*,b.*')
                    ->join('tbl_kantor as b','b.kd_kan','=','a.cabang')
                    ->where('a.id',$id)
                    ->first();
        
        require_once '../vendor/autoload.php';
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/data_pemohon/DATAPEMOHON.docx'));
        
        $my_template->setValue('nama',  $data->namalengkap);
        $my_template->setValue('nik', $data->nik);
        $my_template->setValue('telepon', $data->telepon);
        $my_template->setValue('alamat',  $data->alamat);      
        $my_template->setValue('plafond', $data->nilaidiajukan);      
        $my_template->setValue('tenor', $data->jangkawaktu);      
        $my_template->setValue('cabang', $data->n_kan);      
        $my_template->setValue('tgl', $data->created_at);  
        $my_template->setImageValue('ktp', array('path' => storage_path('app/public/uploads/ktp/'.$data->pathktp), 'width' => 500, 'height' => 250));    
        $my_template->setImageValue('kk',array('path' => storage_path('app/public/uploads/kk/'.$data->pathkk), 'width' => 500, 'height' => 250) );    
      
        try{
            $my_template->saveAs(storage_path('DATAPEMOHON_'.$data->namalengkap.'.docx'));
        }catch (Exception $e){
            //handle exception
        }
    
        return response()->download(storage_path('DATAPEMOHON_'.$data->namalengkap.'.docx'));
        
    }

    //  Download Dokument Surat Permohonan Kredit
    public function createSuratPermohonanKredit($id) {
        
        $user = Auth::user()->name;
        
        $data   = DB::table('nasabah_kredits as a')
                    ->selectRaw('a.*,a.created_at as tglpengajuan,b.*,c.* ,d.*,e.produk tujuankredit,f.nmagama,g.deskripsi as kotakab,h.deskripsi_pekerjaan,i.deskripsi as kotaperusahaan')
                    ->join('tbl_kantor as b','b.kd_kan','=','a.cabang')
                    ->leftJoin('agunan_nasabah as c','a.id','=','c.id_debitur')
                    ->join('pendidikan as d','a.pendidikan','=','d.id')
                    ->join('master_produk as e','a.tujuankredit','=','e.kode_produk')
                    ->join('tbl_agama as f','a.agama','=','f.id_agm')
                    ->join('lbi_ref_18_kabupatenkota as g','a.kota','=','g.sandi')
                    ->join('slik_ref07_pekerjaan as h','a.pekerjaan','=','h.kode_pekerjaan')
                    ->join('lbi_ref_18_kabupatenkota as i','a.kotaperusahaan','=','i.sandi')
                    ->where('a.id',$id)
                    ->first();
        if($data->jk == 'P') 
        { $jk = 'Perempuan'; }else{ $jk ='Laki-laki'; }
        
        $namapemilik = "";
        $pemilikmotor = "";
        $nilaitaksasi2 = "";
        $nilaitaksasi3 = "";
        $pemilikannya = "";
        $deskripsi      = "";

        //tanah bangunan
        if($data->jenisagunan == 6){
            $namapemilik    = $data->nama_pemilik;
            $nilaitaksasi   = $data->nilai_taksasi;
            
        }else // kendaraan 
        if($data->jenisagunan == 5){
            $pemilikmotor   = $data->nama_pemilik;
            $nilaitaksasi2  = $data->nilai_taksasi;
        }else // lainnya
        {
            $pemilikannya   = $data->nama_pemilik; 
            $nilaitaksasi3  = $data->nilai_taksasi;
            $deskripsi      = $data->deskripsi;
        }
        
        require_once '../vendor/autoload.php';
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(storage_path('app/public/data_pemohon/FORMULIR PERMOHONAN KREDIT.docx'));
        
        $my_template->setValue('${user}',  $user);
        $my_template->setValue('${nopengajuan}',  $data->nopengajuan);
        $my_template->setValue('${cabang}',  $data->n_kan);
        $my_template->setValue('${permohonan}', $data->permohonan);
        $my_template->setValue('${tgl}',  date('Y-m-d',strtotime($data->tglpengajuan)));      
        $my_template->setValue('${plafond}', $data->nilaidiajukan);
        $my_template->setValue('${tenor}', $data->jangkawaktu);      
        $my_template->setValue('${tujuankredit}', $data->tujuankredit);
        $my_template->setValue('${jeniskepemilikan}', $data->jenis_kepemilikan);      
        $my_template->setValue('${nopemilik}', $data->no_pemilik);      
        $my_template->setValue('${namapemilik}', $namapemilik);      
        $my_template->setValue('${imb}', $data->IMB);      
        $my_template->setValue('${luasbangunan}', $data->luas_tanah_bangunan);      
        $my_template->setValue('${jatuhtemposhgb}', $data->jatuh_tempo_shgb);      
        $my_template->setValue('${lokasi}', $data->lokasi);      
        $my_template->setValue('${nilaitaksasi}', $data->nilai_taksasi);      
        $my_template->setValue('${jeniskendaraan}', $data->jenis_kendaraan);      
        $my_template->setValue('${merk}', $data->merk);      
        $my_template->setValue('${tahun}', $data->tahun);      
        $my_template->setValue('${nomesin}', $data->no_mesin);      
        $my_template->setValue('${norangka}', $data->no_rangka);      
        $my_template->setValue('${nobpkb}', $data->no_bpkb);      
        $my_template->setValue('${nopolisi}', $data->no_polisi);      
        $my_template->setValue('${nilaitaksasi2}', $nilaitaksasi2);      
        $my_template->setValue('${pemilikmotor}', $pemilikmotor);      
        $my_template->setValue('${jaminan}', $data->jaminan);      
        $my_template->setValue('${pemilikannya}', $pemilikannya);      
        $my_template->setValue('${deskripsi}', $deskripsi);      
        $my_template->setValue('${nik}', $data->nik);      
        $my_template->setValue('${nama}', $data->namalengkap);      
        $my_template->setValue('${namaalias}', $data->namaalias);      
        $my_template->setValue('${masaberlaku}', $data->masaberlaku);      
        $my_template->setValue('${jeniskelamin}', $jk );      
        $my_template->setValue('${kewarganegaraan}', $data->kewarganegaraan);      
        $my_template->setValue('${negara}', $data->negara);      
        $my_template->setValue('${tempatlahir}', $data->tempatlahir);      
        $my_template->setValue('${tgllahir}', date('Y-m-d',strtotime($data->tgllahir)));      
        $my_template->setValue('${alamat}', $data->alamat);      
        $my_template->setValue('${kota}', $data->kotakab);      
        $my_template->setValue('${kodepos}', $data->kodepos);      
        $my_template->setValue('${telepon}', $data->telepon);      
        $my_template->setValue('${hp}', $data->hp);      
        $my_template->setValue('${status}', $data->status);      
        $my_template->setValue('${agama}', $data->nmagama);      
        $my_template->setValue('${npwp}', $data->npwp);      
        $my_template->setValue('${pendidikan}', $data->pendidikan);      
        $my_template->setValue('${jumlahtanggungan}', $data->jmlhtanggungan);      
        $my_template->setValue('${pekerjaan}', $data->deskripsi_pekerjaan);      
        $my_template->setValue('${jabatan}', $data->jabatan);      
        $my_template->setValue('${perusahaan}', $data->perusahaan);      
        $my_template->setValue('${alamatperusahaan}', $data->alamatperusahaan);      
        $my_template->setValue('${kodeposperusahaan}', $data->kodeposperusahaan);      
        $my_template->setValue('${kotaperusahaan}', $data->kotaperusahaan);      
        $my_template->setValue('${teleponsaudara}', $data->teleponsaudara);      
        $my_template->setValue('${namasuamiistri}', $data->namasuamiistri);      
        $my_template->setValue('${ibukandung}', $data->namaibukandung);  
        $my_template->setValue('${kecamatan}', $data->kecamatan);      
        $my_template->setValue('${nilaitaksasi3}', $nilaitaksasi3);      
        
        $my_template->setImageValue('${fotoktp}', array('path' => storage_path('app/public/uploads/ktp/'.$data->pathktp), 'width' => 300, 'height' => 200));    
        $my_template->setImageValue('${fotokk}',array('path' => storage_path('app/public/uploads/kk/'.$data->pathkk), 'width' => 600, 'height' => 350) );    
        $my_template->setImageValue('${fotoktppasangan}',array('path' => storage_path('app/public/uploads/ktppasangan/'.$data->pathktppasangan), 'width' => 300, 'height' => 200) );    
        $my_template->setImageValue('${fotojaminan}',array('path' => storage_path('app/public/uploads/suratjaminan/'.$data->pathsuratjaminan), 'width' => 500, 'height' => 500) );    
        
        try{
            $my_template->saveAs(storage_path('SuratPemohonanKredit_'.$data->namalengkap.'.docx'));
        }catch (Exception $e){
            //handle exception
        }
    
        return response()->download(storage_path('SuratPemohonanKredit_'.$data->namalengkap.'.docx'));
        
    }

    public function downloadagunan($id,$file){
        $filename = NasabahKredit::find($id); 
        $zip        = new ZipArchive;
        $filepath = "";
        $name = "";
        
        // Set Header
        $headers = array(
            'Content-Type' => 'application/octet-stream',
        );
       
        if($file == "ktp"){
            $fileopen = public_path('storage/uploads/ktp');
            $filetopath = $fileopen.'/'. $filename->pathktp;
            $name       = $filename->pathktp;
        } else if($file == "kk"){
            $fileopen = public_path('storage/uploads/kk');
            $filetopath = $fileopen.'/'. $filename->pathkk;
            $name = $filename->pathkk;
        } else if($file == "ktppasangan"){
            $fileopen = public_path('storage/uploads/ktppasangan');
            $filetopath = $fileopen.'/'. $filename->pathktppasangan;
            $name = $filename->pathktppasangan;
        } else {
            $fileopen = public_path('storage/uploads/suratjaminan');
            $filetopath = $fileopen.'/'. $filename->pathsuratjaminan;
            $name = $filename->pathsuratjaminan;
        }
       
        if(file_exists($filetopath)){
            return response()->download($filetopath, $name,$headers);
        }else{
            return "test";
        }
    }

    public function showNasabahBaru()
    {
        //
        $title = "Tabungan Nasabah Baru";
        $data = NasabahBaru::all();
        return view('backend.nasabahbaru.list', compact('title','data'));
    }


    public function showKreditNasabah()
    {

        $title  = "Nasabah Kredit";
    
        $akses      = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();
        $user       = $akses->name;
        
        if($akses->role_id == 1 || $akses->role_id == 2 || $akses->role_id == 3){
            $data   = DB::table('nasabah_kredits as a')
                    ->selectRaw('a.*,b.n_kan')
                    ->leftJoin('tbl_kantor as b','b.kd_kan','=','a.cabang')
                    ->orderBy('a.created_at','desc')
                    ->get();
                    
        }else if($akses->role_id == 4){
            $data   = DB::table('nasabah_kredits as a')
                    ->selectRaw('a.*,b.n_kan')
                    ->join('tbl_kantor as b','b.kd_kan','=','a.cabang')
                    ->join('groups as c','c.cabang','=','a.cabang')
                    ->join('users as d','d.id','=','c.id_user')
                    ->where('d.id',$akses->id)
                    ->where('b.kd_kan',$akses->kode_kantor)
                    ->orderBy('a.created_at','desc')
                    ->get();
        }

        $datakredit = "active";
        $kredit = "active";
        
        
       return view('backend.kredit.list',
                ['title' => $title, 'data' => $data,'user' => $user,'akses' => $akses,'namakantor' => $namakantor,'datakredit' => $datakredit, 'kredit' => $kredit ]
            );
    }

    public function editKreditNasabah($id,$action){
        $title      = "Nasabah Kredit";

        $akses      = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();
        $slik_pekerjaan = Pekerjaan::all();

        if($action == 1){
            $data       = Nasabah::where('no_id',$id)->first();
           
        }else
        if($action == 2){
            
            $data      = DB::table('nasabah_kredits as a')
                            ->selectRaw('a.id,
                                     a.namalengkap as nama_nasabah,
                                     a.namaalias as nama_alias,
                                     a.tempatlahir,
                                     a.negara as negara_domisili,
                                     a.nik as no_id,
                                     a.masaberlaku as masa_berlaku_ktp,
                                     a.cabang as kode_kantor,
                                     a.tgllahir,
                                     a.kewarganegaraan,
                                     a.jk as jenis_kelamin,
                                     a.status as status_marital,
                                     a.agama as kode_agama,
                                     a.npwp,
                                     a.alamat as alamat_ktp,
                                     a.kota as kota_kab,
                                     a.kodepos as kodepos,
                                     a.telepon,
                                     a.hp as slik_telpon,
                                     a.pendidikan,
                                     a.jmlhtanggungan as jumlah_tanggungan,
                                     a.pekerjaan,
                                     a.jabatan, 
                                     a.perusahaan as nama_kantor, 
                                     a.alamatperusahaan as alamat_kantor, 
                                     a.kotaperusahaan, 
                                     a.kodeposperusahaan, 
                                     a.namasuamiistri as nama_suami_atau_istri,
                                     a.namaibukandung as nama_ibu_kandung,
                                     a.nikpasangan as no_id_pasangan,
                                     a.tgllahirpasangan as tgl_lahir_suami_atau_istri,
                                     a.teleponsaudara as phone_number,
                                     a.hpsaudara as phone_number,
                                     a.permohonan,
                                     a.tglpengajuan as tgl_pengajuan,
                                     a.nilaidiajukan,
                                     a.jangkawaktu,
                                     a.tujuankredit,
                                     a.kettujuankredit,
                                     a.jaminan,
                                     a.pathktp,
                                     a.email,
                                     a.pathkk,
                                     a.pathktppasangan,
                                     a.pathsuratjaminan,
                                     a.nogenerateslik1,
                                     a.nogenerateslik2,
                                     b.n_kan')
                        ->leftJoin('tbl_kantor as b','b.kd_kan','=','a.cabang')
                        ->where('a.id',$id)
                        ->orderBy('a.created_at','desc')
                        ->first();    
        }


        //role
        if($akses->role_id == 1){
            $cabang     = Kantor::all();
        }else{
            $cabang     = Kantor::where('kd_kan',$akses->kode_kantor)->get();
            
        }
        
        
        $agunan = DB::table('agunan_nasabah')
                    ->where('id_debitur',$id)
                    ->get();
        
       return view('backend.kredit.edit.edit',
                [   
                    'title' => $title,
                    'data' => $data,
                    // 'user' => $user,
                    'agunan' => $agunan,
                    // 'jabatan' => $jabatan,
                    'cabang' => $cabang,
                    'pekerjaan' => $slik_pekerjaan,
                    'kabupatenkota' => KabupatenKota::all(),
                    'akses' => $akses,
                    'namakantor' => $namakantor,
                    'produkkredit' => DB::table('master_produk')->get()
                ]);
    }

    
    public function getNoUrutNasabahByKodeCabang($byKodeCabang){

        $data = NasabahKredit::where('cabang',$byKodeCabang)->max('id');
                
        if($data != 0){

            $data = $data;
                        
        }else{

            $data = "Tidak ada data.";
            
        }

        return response()->json(
            [
                'data'    => $data,
                'success' => true,
                'message' => 'success'
            ],200
        );

    }

    public function generateSlikDanNoPengajuan($parameter){



        //proses create no pengajuan
        $cabang         = $parameter['cabang'];
        
        $lastid         = $this->getNoUrutNasabahByKodeCabang($parameter['cabang']);
        
        $get            = json_decode(json_encode($lastid));
        
        $tglpengajuan   = date('Ymd',strtotime($parameter['tglpengajuan']));

        //generate no pangajuan
        $nopengajuan    = $cabang.'-'.$tglpengajuan.'-'.$parameter['id'];   //$get->original->data;

        //generate slik 1
        $tgllahir       =  $nopengajuan.'-'. $this->generateNoIDslik($parameter['id'],""); 
        

        //generate slik 2
        $tgllahirpas    =  $nopengajuan.'-'. $this->generateNoIDslik($parameter['id'],2);


        return [
            "nopengajuan"   => $nopengajuan,
            "slik1"         => $tgllahir,
            "slik2"         => $tgllahirpas
        ];
      
        
    }

    public function generateNoIDslik($id,$add){
        
        if($add == ""){
            $id = (int)$id;
        }else{
            $id = (int)$id+1;
        }
        
        if(strlen($id) == "1"){
            $no = "000".$id;
        }else 
        if(strlen($id) == "2"){
            $no = "00".$id;
        }else 
        if(strlen($id) == "3"){
            $no = $id;
        }

        return $no;
    }


    /*
      * @description __construct
      * @param request
    */
    function selectDebtor(Request $request)
    {
        
        if($request->ajax())
        {
            $forTest='';
            $output = '';
            $temp = 0;
            $query = $request->get('query');
            $data = 0;
            
            if($query != '')
            {
                
                $data_all = Nasabah::query()
                                    ->where('nama_nasabah','like','%'.$query.'%')
                                    ->orWhere('no_id','like','%'.$query.'%')
                                    ->get();
                
                
                if(count($data_all) == 0){
                    $data_all = NasabahKredit::query()
                                    ->select('namalengkap as nama_nasabah','nik as no_id','tempatlahir','tgllahir','alamat','namaibukandung as nama_ibu_kandung')
                                    ->where('proses_pengajuan','!=','proses')
                                    ->where('proses_pengajuan','!=','pending')
                                    ->where('namalengkap','like','%'.$query.'%')
                                    ->orWhere('nik','like','%'.$query.'%')
                                    ->get();
                    if(count($data_all) > 0){
                        $data = $data_all;
                    }else{
                        $data = 0;
                    } 
                    
                }if(count($data_all) > 1){
                    $data = $data_all;
                }else{
                    $data = $data_all;
                }

            }
            else
            {
                $data = 0;
            }

                        
            if(count($data) > 0)
            {

                foreach($data as $row)
                {
                    
                    $photo = 'url('.env('APP_URL').'/assets/img/customer.png)';

                    $output .= '  <div class="col-xl-12"><div id="c_'.$temp.'" class="card border shadow-0 shadow-sm-hover mb-1" data-filter-tags="oliver kopyov">
                                    <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                                        <div class="d-flex flex-row align-items-center">
                                            <span class="status status-success mr-3">
                                                <span class="rounded-circle profile-image d-block " style="background-image:'.$photo.'; background-size: cover;"></span>
                                            </span>
                                            <div class="info-card-text flex-1">
                                                <a href="javascript:void(0);" class="fs-xl text-truncate text-truncate-lg text-info" data-toggle="dropdown" aria-expanded="false">
                                                    '.$row->nama_nasabah.'
                                                   
                                                </a>
                                                
                                                <span class="text-truncate text-truncate-xl">'.$row->no_id.'</span>
                                            </div>
                                            <a id="js-expand-btn" class="js-expand-btn btn btn-sm btn-default waves-effect waves-themed collapsed" data-toggle="collapse" data-target="#c_'.$temp.' > .card-body + .card-body" aria-expanded="false">
                                                <span class="collapsed-hidden">+</span>
                                                <span class="collapsed-reveal">-</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 collapse" style="">
                                        <div class="p-3">
                                            <a  class="mt-1 d-block fs-sm fw-700 text-dark">
                                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> TEMPAT, TANGGAL LAHIR :'. strtoupper($row->tempatlahir).', '.$row->tgllahir.'</a>
                                            <a  class="mt-1 d-block fs-sm fw-700 text-dark">
                                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> NAMA IBU KANDUNG  :'.strtoupper($row->nama_ibu_kandung).'</a>
                                            <a  class="mt-1 d-block fs-sm fw-400 text-dark">
                                                <i class="fas fa-mouse-pointer text-muted mr-2"></i> ALAMAT   :'.strtoupper($row->alamat).'</a>
                                        </div>
                                        <div class="p-6">
                                            <a href="#" class="btn btn-primary ml-auto" type="submit" onclick="selectCheckData(\''.$row->no_id.'\')">Select</a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    
                    $temp++;
                }

            }
            else
            {
                $output = '<div class="col-md-12">
                                <div  class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="oliver kopyov">
                                    <div class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Data tidak di temukan. Apakah ingin dibuatkan pengajuan kredit?</strong><br>
                                        </div>
                                        <div class="p-6">
                                            <a href="nasabah/tambah" class="btn btn-primary ml-auto" type="submit" >Tambah</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';

            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $temp,
                'forTest' => $forTest
            );

            return $data;
        }
       
    }


    function selectCheckData(Request $request){

        if($request->ajax()){

            $checkdata = NasabahKredit::where('nik',$request->all()['query'])
                            ->first();
           
                            
            if(isset($checkdata->proses_pengajuan)){
                
                if($checkdata->proses_pengajuan == "pending" || $checkdata->proses_pengajuan == "proses"){

                    $info = '<div class="col-xl-12">
                                <div  class="card border shadow-0 mb-g shadow-sm-hover" data-filter-tags="oliver kopyov">
                                    <div class="alert alert-warning">
                                        
                                                <h5>
                                                    Nasabah sudah dalam pengajuan proses kredit :
                                                </h5>
                                                
                                            <div class="p-3">
                                                <a  class="mt-1 d-block fs-sm fw-700 text-dark">
                                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i> NO PENGAJUAN KREDIT : '. strtoupper($checkdata->nopengajuan).'</a>
                                                <a  class="mt-1 d-block fs-sm fw-700 text-dark">
                                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i> NAMA  : '.strtoupper($checkdata->namalengkap).'</a>
                                                <a  class="mt-1 d-block fs-sm fw-400 text-dark">
                                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i> TANGGAL PENGAJUAN : '.date('Y-m-d',strtotime($checkdata->created_at)).'</a>
                                                <a  class="mt-1 d-block fs-sm fw-400 text-dark">
                                                    <i class="fas fa-mouse-pointer text-muted mr-2"></i> STATUS PENGAJUAN : '.strtoupper($checkdata->proses_pengajuan).'</a>
                                            </div>

                                    </div>
                                </div>
                            </div>';
                    $message = 'Data ditemukan';
                    $status  = 1;

                }else{
                    
                    $info = $request->all()['query'];
                    $message = 'Data tidak ditemukan.';
                    $status  = 0;

                }

            }else{
                $info = $request->all()['query'];
                $message = 'Data tidak ditemukan.';
                $status  = 0;
            }

            return response()->json([
                'info' => $info,
                'message' => $message,
                'status' => $status
            ], 200);
        }
    }




    //######################### UPLOAD FILE ###########################
   public function uploadFile(Request $request){
        
        if($request->file('ktp')){
          
            $imagePathktp = $request->file('ktp');

            // GIVE NAME FILE
            $imageNamektp = Carbon::now()->format('YmdHi').$imagePathktp->getClientOriginalName();
            

            // UPLOAD IMAGE
            $pathktp = $request->file('ktp')->storeAs('/uploads/ktp', $imageNamektp, 'public');
            $result = Nasabahkredit::where('id',$request->id_debitur)->update(['pathktp' => $imageNamektp]);
            return $result;
            
        }

        if($request->file('kk')){
            $imagePathkk = $request->file('kk');

            // GIVE NAME FILE
            $imageNamekk = Carbon::now()->format('YmdHi').$imagePathkk->getClientOriginalName();

            // UPLOAD IMAGE
            $pathktp = $request->file('kk')->storeAs('/uploads/kk', $imageNamekk, 'public');
            $result = Nasabahkredit::where('id',$request->id_debitur)->update(['pathkk' => $imageNamekk]);
            return $result;
            
        }

        if($request->file('ktppasangan')){
            $imagePathkp = $request->file('ktppasangan');

            // GIVE NAME FILE
            $imageNamekp = Carbon::now()->format('YmdHi').$imagePathkp->getClientOriginalName();

            // UPLOAD IMAGE
            $pathkp = $request->file('ktppasangan')->storeAs('/uploads/ktppasangan', $imageNamekp, 'public');
            $result = Nasabahkredit::where('id',$request->id_debitur)->update(['pathktppasangan' => $imageNamekp]);
            return $result;
            
        }

        if($request->file('suratjaminan')){
            $imagePathsj = $request->file('suratjaminan');

            // GIVE NAME FILE
            $imageNamesj = Carbon::now()->format('YmdHi').$imagePathsj->getClientOriginalName();

            // UPLOAD IMAGE
            $pathsj = $request->file('suratjaminan')->storeAs('/uploads/suratjaminan', $imageNamesj, 'public');
            $result = Nasabahkredit::where('id',$request->id_debitur)->update(['pathsuratjaminan' => $imageNamesj]);
            return $result;
        }
        
   }

   public function deleteFile(Request $request,$id_deb){
        dd($id_deb);
        $check = File::delete('uploads/ktp/'.$request->file);
        dd($check);die;
   }

   public function redirect(){
    //    dd("dd");
        return Redirect::to(url()->previous());
   }

   



    
}
