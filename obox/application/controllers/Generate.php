<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Generate extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Core_model');
        $this->load->model('Obox_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('file');
         // Load zip library
        $this->load->library('zip');
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }


    public function index()
    {
        
            $data['generate']="active";
            $data['headerpage']="show";
            $data['data'] = $this->Obox_model->getlastid();
            
            $this->template->load('template/template','obox/form',$data);
  
    }


    public function create()
    {
        $data['sukses']="";
        $data['input_antrian_active']="active";
        $this->template->load('template/template','antrian/input_antrian',$data);

    }

    public function inisialisasi(){
        $data['sukses']="";
        $data['inisialisasi']="active";
        $data['headerpage']="show";
        $data['data_user_active']="active";
        $data['data_users_visible']="visible";
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $data['init']   = $this->Obox_model->getAll();
      
        $this->template->load('template/template','obox/inisialisasi',$data);
    }
    
    public function store(){

        $input = [
            'kodejenisljk'  => $this->input->post('kode_jenis_ljk'),
            'kodeljk'       => $this->input->post('kode_ljk'),
            'daritgl'       => date('Y-m-d',strtotime($this->input->post('daritgl'))),
            'sampaitgl'       => date('Y-m-d',strtotime($this->input->post('sampaitgl'))),
            'tgllaporan'    => date('Y-m-d'),
            'periodebatassebelum' => $this->input->post('batasperiode'),
            'user'          =>   $this->session->userdata("email"),
            'created_at'    => date('Y-m-d H:i:s')
        ];

        

        $data = $this->Obox_model->insertInisialisasi($input);

        if($data == 'true'){
            $this->session->set_flashdata('message', 'Data berhasil di simpan.');
        }else{
            $this->session->set_flashdata('message', 'Data gagal di simpan.');
        }
        
        redirect(site_url('generate/inisialisasi'));
        
    }

    //================== 
    function tampilCR006()
    {
        $minggu1       = $this->input->post('daritgl');
        $minggu2       = $this->input->post('sampaitgl');
        $id_inisial       = $this->input->post('id_inisial');

        $data['hasil'] = $this->Obox_model->getDataCR006($minggu1,$minggu2);
        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataCR006core($minggu1,$minggu2);
            if(!is_null($temp)){
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'kode_kantor' => $items['kode_kantor'],
                        'nama_nasabah' => $items['nama_nasabah'],
                        'no_cif' => $items['no_cif'],
                        'nik' => $items['nik'],
                        'kode_kelompok_kredit' => $items['kode_kelompok_kredit'],
                        'no_rekening' => $items['no_rekening'],
                        'jenis_kredit' => $items['jenis_kredit'],
                        'tanggal_mulai' => $items['tanggal_mulai'],
                        'tanggal_jatuh_tempo' => $items['tanggal_jth_tempo'],
                        'jenis_debitur' => $items['jenis_debitur'],
                        'sektor_ekonomi' => $items['sektor_ekonomi'],
                        'kategori_usaha' => $items['kategori_usaha'],
                        'suku_bunga' => $items['suku_bunga_per_tahun'],
                        'perhitungan_suku_bunga' => $items['perhitungan_suku_bunga'],
                        'jml_pinjaman' => $items['jml_pinjaman'],
                        'jml_pinjaman_efektif' => $items['jml_pinjaman_efektif'],
                        'baki_debet' => $items['baki_debet'],
                        'jenis_agunan' => $items['jenis_agunan'],
                        'nilai_agunan' => $items['nilai_agunan'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                $result = $this->Obox_model->storeCR006($input);
                
                }
            }

            $data['hasil'] = $this->Obox_model->getDataCR006($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listCR006',$data);
    }

    
    function tampilCR007()
    {
        $minggu1       = $this->input->post('daritgl');
        $minggu2       = $this->input->post('sampaitgl');
        $id_inisial       = $this->input->post('id_inisial');

        $data['hasil'] = $this->Obox_model->getDataCR007($minggu1,$minggu2);
       
        if(empty($data['hasil'])){
            
            $input = [
                'flag_detail' => 'D',
                'kodejenisljk' => '01020101',
                'kodeljk' => '600420',
                'typelaporan' => 'A',
                'periode' => str_replace("-","",$minggu2),
                'total' => '0',
                'id_inisialisasi' => $id_inisial,
                'created_at' => date('Y-m-d H:i:s')
            ];
                
            $result = $this->Obox_model->storeCR007($input);
           
    
            $data['hasil'] = $this->Obox_model->getDataCR007($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listCR007',$data);
    }

    //=================== Get Show CR008 ==================//
    function tampilCR008()
    {
        $minggu1       = $this->input->post('daritgl');
        $minggu2       = $this->input->post('sampaitgl');
        $id_inisial       = $this->input->post('id_inisial');
        $periodebatassebelum = $this->input->post('periodebatassebelum');
		
        $data['hasil'] = $this->Obox_model->getDataCR008($minggu1,$minggu2);
		// var_dump($data['hasil']);die;
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataCR008Core($minggu1,$minggu2);
           
            if(!is_null($temp)){
        
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'kode_kantor' => $items['kode_kantor'],
                        'nama_nasabah' => $items['nama_nasabah'],
                        'no_cif' => $items['no_cif'],
                        'nik' => $items['nik'],
                        'kode_kelompok_kredit' => $items['kode_kelompok_kredit'],
                        'no_rekening' => $items['no_rekening'],
                        'jenis_debitur' => $items['jenis_debitur'],
                        'plafond_sebelum' => $items['plafond_sebelum'],
                        'plafond_sesudah' => $items['plafond_sesudah'],
                        'peningkatan_penurunan_plafond' => $items['peningkatan_penurunan_plafond'],
                        'baki_debet_sebelum' => $items['baki_debet_sebelum'],
                        'baki_debet_sesudah' => $items['baki_debet_sesudah'],
                        'penurunan_baki_debet' => $items['penurunan_baki_debet'],
                        'rek_sebelum' => $items['REK_SEBELUM'],
                        'rek_sesudah' => $items['REK_SESUDAH'],
                        'penyebab_penurunan' => $items['penyebab_penurunan'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                $result = $this->Obox_model->storeCR008($input);
                // var_dump($result);die;
                }
            }

            $data['hasil'] = $this->Obox_model->getDataCR008($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listCR008',$data);
    }

    //=================== Get Show CR009 ==================//
    function tampilCR009()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        $id_inisial             = $this->input->post('id_inisial');
        $periodebatassebelum    = $this->input->post('periodebatassebelum');
       
        $data['hasil'] = $this->Obox_model->getDataCR009($minggu1,$minggu2);
        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataCR009Core($minggu1,$minggu2);
            if(!is_null($temp)){
               
                foreach($temp as $items){
                  
                    $tanggalKolek = $this->getDateCollect($items['no_rekening'],$minggu1,$minggu2,$items['kolekbaru']); 
                  
                    $input = [
                        'flag_detail' => $items['Flag'],
                        'kode_kantor' => $items['kode_kantor'],
                        'nama_nasabah' => $items['nama_nasabah'],
                        'no_cif' => $items['no_cif'],
                        'nik' => $items['nik'],
                        'kode_kelompok_kredit' => $items['kode_kelompok_kredit'],
                        'no_rekening' => $items['no_rekening'],
                        'jenis_kredit' => $items['jenis_kredit'],
                        'jenis_debitur' => $items['jenis_debitur'],
                        'sektor_ekonomi' => $items['SEKTOR_EKONOMI'],
                        'kategori_usaha' => $items['kategori_usaha'],
                        'suku_bunga' => $items['suku_bunga'],
                        'perhitungan_suku_bunga' => $items['perhitungan_suku_bunga'],
                        'jumlah_rekening' => $items['jumlah_rekening'],
                        'perubahan_kualitas' => $items['perubahan_kualitas'],
                        'tanggal' => $tanggalKolek,
                        'kualitas_lama' => $items['koleklama'],
                        'kualitas_baru' => $items['kolekbaru'],
                        'penyebab_kualitas' => $items['penyebab_kualitas'],
                        'plafond' => $items['plafond'],
                        'baki_debet' => $items['baki_debet'],
                        'jenis_agunan' => $items['jenis_agunan'],
                        'nilai_agunan' => $items['nilai_agunan'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
					$result = $this->Obox_model->storeCR009($input);
               
                }
            }

            $data['hasil'] = $this->Obox_model->getDataCR009($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listCR009',$data);
    }

    //=================== Get Show OP001 ==================//
    function tampilOP001()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        $id_inisial             = $this->input->post('id_inisial');
        // $periodebatassebelum    = $this->input->post('periodebatassebelum');
       
        $data['hasil'] = $this->Obox_model->getDataOP001($minggu1,$minggu2);
        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataOP001Core($minggu1,$minggu2);
            if(!is_null($temp)){
        
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'kode_kantor' => $items['kode_kantor'],
                        'tanggal' => $items['tanggal'],
                        'saldo_awal' => $items['saldo_awal'],
                        'debet' => $items['debet'],
                        'kredit' => $items['kredit'],
                        'saldo_akhir' => $items['saldo_akhir'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                $result = $this->Obox_model->storeOP001($input);
                // var_dump($result);die;
                }
            }

            $data['hasil'] = $this->Obox_model->getDataOP001($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listOP001',$data);
    }

    //=================== Get Show OP002 ==================//
    function tampilOP002()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        $id_inisial             = $this->input->post('id_inisial');
        // $periodebatassebelum    = $this->input->post('periodebatassebelum');
       
        $data['hasil'] = $this->Obox_model->getDataOP002($minggu1,$minggu2);
        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataOP002Core($minggu1,$minggu2);
            if(!is_null($temp)){
        
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'no_cif' => $items['no_cif'],
                        'sandi_bank' => $items['sandi_bank'],
                        'lokasi_bank' => $items['lokasi_bank'],
                        'no_rekening_bank_penempatan' => $items['no_rekening_bank_penempatan'],
                        'jenis' => $items['jenis'],
                        'saldo_awal' => $items['saldo_awal'],
                        'debet' => $items['debet'],
                        'kredit' => $items['kredit'],
                        'saldo_akhir' => $items['saldo_akhir'],
                        
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                $result = $this->Obox_model->storeOP002($input);
                // var_dump($result);die;
                }
            }

            $data['hasil'] = $this->Obox_model->getDataOP002($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listOP002',$data);
    }

    //=================== Get Show LQ003 ==================//
    function tampilLQ003()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        $id_inisial             = $this->input->post('id_inisial');
        // $periodebatassebelum    = $this->input->post('periodebatassebelum');
        
        $data['hasil'] = $this->Obox_model->getDataLQ003($minggu1,$minggu2);

        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataLQ003Core($minggu1,$minggu2);
            
            if(!is_null($temp)){
        
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'no_cif' => $items['no_cif'],
                        'nama_nasabah' => $items['nama_nasabah'],
                        'no_identitas' => $items['no_identitas'],
                        'jenis_dpk' => $items['jenis_dpk'],
                        'nominal' => $items['nominal'],
                        'no_rekening' => $items['no_rekening'],
                        'jml_trx' => $items['jml_trx'],
                        'keterangan' => $items['keterangan'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                $result = $this->Obox_model->storeLQ003($input);
                // var_dump($result);die;
                }
            }

            $data['hasil'] = $this->Obox_model->getDataLQ003($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listLQ003',$data);
    }

    //=================== Get Show LQ004 ==================//
    function tampilLQ004()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        $id_inisial             = $this->input->post('id_inisial');
        // $periodebatassebelum    = $this->input->post('periodebatassebelum');
        
        $data['hasil'] = $this->Obox_model->getDataLQ004($minggu1,$minggu2);
  
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataLQ004Core($minggu1,$minggu2);
           
            if(!is_null($temp)){
        
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'no_cif' => $items['no_cif'],
                        'nama_nasabah' => $items['nama_nasabah'],
                        'no_identitas' => $items['no_identitas'],
                        'jenis_dpk' => $items['jenis_dpk'],
                        'nominal' => $items['nominal'],
                        'no_rekening' => $items['no_rekening'],
                        'jml_trx' => $items['jml_trx'],
                        'keterangan' => $items['keterangan'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                   
                    $result = $this->Obox_model->storeLQ004($input);
                    
                }
            }

            $data['hasil'] = $this->Obox_model->getDataLQ004($minggu1,$minggu2);   
        }

        $this->load->view('obox/tabel/listLQ004',$data);
    }

    //=================== Get Show LQ005 ==================//
    function tampilLQ005()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        $id_inisial             = $this->input->post('id_inisial');
        // $periodebatassebelum    = $this->input->post('periodebatassebelum');
       
        $data['hasil'] = $this->Obox_model->getDataLQ005($minggu2);
        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataLQ005Core($minggu2);
            if(!is_null($temp)){
        
                foreach($temp as $items){
                    $input = [
                        'flag_detail' => $items['flag_detail'],
                        'periode' => date('Y-m-d',strtotime($items['periode'])),
                        'kas' => $items['kas'],
                        'giro' => $items['giro'],
                        'selisih' => $items['selisih'],
                        'tab_aba' => $items['tab_aba'],
                        'tab_bank_abp' => $items['tab_bank_abp'],   
                        'tab_bpr_abp' => $items['tab_bpr_abp'],   
                        'jml_likuid' => $items['jml_likuid'],
                        'kewajiban_segera' => $items['kewajiban_segera'],
                        'tab_dpk' => $items['tab_dpk'],
                        'dep_dpk' => $items['dep_dpk'],
                        'jml_kewajiban' => $items['jml_kewajiban'],
                        'cash_ratio' => $items['cash_ratio'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                
                    $result = $this->Obox_model->storeLQ005($input);
                    
                }
            }

            $data['hasil'] = $this->Obox_model->getDataLQ005($minggu2);   
        }

        $this->load->view('obox/tabel/listLQ005',$data);
    }

    //=================== Get Show LQ005 ==================//
    function tampilLQ006()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
        
        $id_inisial             = $this->input->post('id_inisial');
        // $periodebatassebelum    = $this->input->post('periodebatassebelum');
        
        $data['hasil'] = $this->Obox_model->getDataLQ006($minggu2);
        
        if(empty($data['hasil'])){

            $temp      = $this->Core_model->getDataLQ006Core($minggu2);
            
            if(!is_null($temp)){
                // var_dump($temp);die;
                // foreach($temp as $items){
                    // var_dump($temp);die;
                    $input = [
                        'flag_detail'   => $temp[0]['flag_detail'],
                        'periode'       => date('Y-m-d',strtotime($temp[0]['periode'])),
                        'kyd_bank_lain' => $temp[0]['kyd_bank_lain'],
                        'kyd_nasabah'   => $temp[0]['kyd_nasabah'],
                        'jml_kyd'       => $temp[0]['jml_kyd'],
                        'dpk'           => $temp[0]['dpk'],
                        'kyd_bi'        => $temp[0]['kyd_bi'],   
                        'abp_dep'       => $temp[0]['abp_dep'],   
                        'abp_kyd'       => $temp[0]['abp_kyd'],
                        'abp_bukan_bank' => $temp[0]['abp_bukan_bank'],
                        'abp_modal'     => $temp[0]['abp_modal'],
                        'modal_inti'    => $temp[0]['modal_inti'],
                        'jml_dana'      => $temp[0]['jml_dana'],
                        'ldr' => $temp[0]['ldr'],
                        'id_inisialisasi' => $id_inisial,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    // var_dump($input);die;
                    $result = $this->Obox_model->storeLQ006($input);
                 
                // }
            }

            $data['hasil'] = $this->Obox_model->getDataLQ006($minggu2);   
        }

        $this->load->view('obox/tabel/listLQ006',$data);
    }


    //================== Generate TXT =======================//
    //=================== TXT CR006 ==================//
    function txtcr006($minggu1, $minggu2){
        
        $temp       = $this->Obox_model->getDataCR006($minggu1,$minggu2);
        $namafile   = "01020101.600420.CR006-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.CR006-A.".str_replace("-","",$minggu2).".ready";
        $separator  = "|";


        // header file text
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($namafile));
        header('Content-Disposition: attachment; filename='.basename($fileready));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        $file = fopen($namafile,"w");  
        $fileReady_ = fopen($fileready,"w");  

        $isi  = "";
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  

        foreach($temp as $data){
            
            if($data['nilai_agunan'] == 0) { $nilaiagunan = "";}else{ $nilaiagunan = number_format($data['nilai_agunan'],0,'.',''); }
            if($data['flag_detail'] != 'H') {}
            $isi = 'D'.'|'.$data['kd_kantor_ojk'].
                    '|'.$data['nama_nasabah'].
                    '|'.$data['no_cif'].
                    '|'.$data['nik'].
                    '|'.$data['kode_kelompok_kredit'].
                    '|'.$data['no_rekening'].
                    '|'.$data['jenis_kredit'].
                    '|'.str_replace("-","",$data['tanggal_mulai']).
                    '|'.str_replace("-","",$data['tanggal_jatuh_tempo']).
                    '|'.$data['jenis_debitur'].
                    '|'.$data['sektor_ekonomi'].
                    '|'.$data['kategori_usaha'].
                    '|'.number_format($data['suku_bunga'],2).
                    '|'.$data['perhitungan_suku_bunga'].
                    '|'.number_format($data['jml_pinjaman'], 0, '.', '').
                    '|'.number_format($data['jml_pinjaman_efektif'], 0, '.', '').
                    '|'.number_format($data['baki_debet'], 0, '.', '').
                    '|'.$data['jenis_agunan'].
                    '|'.$nilaiagunan."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file);
        fclose($fileReady_);
       
          // Add file
        $zip    = "01020101.600420.CR006-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;
    
        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);
        $this->zip->download($zip);
        
        $rmc = unlink(FCPATH.$filepath2);
        
        return $rmc;
     
    }
    //=================== TXT CR007 ==================//
    function txtcr007($minggu1, $minggu2){
        
        $namafile   = "01020101.600420.CR007-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.CR007-A.".str_replace("-","",$minggu2).".ready";
              

        $file = fopen($namafile,"w"); 
        $fileReady_ = fopen($fileready,"w");   
        $isi  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|0'."\r\n";
        fwrite($file,$isi);  
        fclose($file); 
        fclose($fileReady_);

        // header file text 1 
        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namafile);
        header('Content-Disposition: attachment; filename='.basename($fileready));
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        // Add file
        $zip    = "01020101.600420.CR007-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;
     
        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);
     
        return $this->zip->download($zip);
    }
    //=================== TXT CR008 ==================//
    function txtcr008($minggu1,$minggu2){
        
        $temp       = $this->Obox_model->getDataCR008($minggu1,$minggu2);
        $namafile   = "01020101.600420.CR008-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.CR008-A.".str_replace("-","",$minggu2).".ready";

        $separator  = "|";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namafile);

        $file = fopen($namafile,"w");  
        $fileReady_ = fopen($fileready,"w");   

        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  

        if($data['rek_sebelum'] == ''){ $rek_sebelum=1; }else{ $rek_sebelum = $data['rek_sebelum']; }
        foreach($temp as $data){
            
            if($data['peningkatan_penurunan_plafond'] == null) { $peningkatan_penurunan_plafond = 0;}else{ $peningkatan_penurunan_plafond = $data['peningkatan_penurunan_plafond']; }
            if($data['peningkatan_penurunan_plafond'] == null) { $peningkatan_penurunan_plafond = 0;}else{ $peningkatan_penurunan_plafond = $data['peningkatan_penurunan_plafond']; }
            $isi = 'D'.'|'.$data['kd_kantor_ojk'].'|'.$data['nama_nasabah'].'|'.$data['no_cif'].'|'.$data['nik'].'|'.$data['kode_kelompok_kredit'].
                    '|'.$data['no_rekening'].'|'.$data['jenis_debitur'].'|'.number_format($data['plafond_sebelum'], 0, '.', '').
                    '|'.number_format($data['plafond_sesudah'], 0, '.', '').'|'.$peningkatan_penurunan_plafond.
                    '|'.number_format($data['baki_debet_sebelum'], 0, '.', '').'|'.number_format($data['baki_debet_sesudah'], 0, '.', '').'|'.number_format($data['penurunan_baki_debet'], 0, '.', '').'|'.number_format($rek_sebelum, 0, '.', '').
                    '|'.number_format($data['rek_sesudah'], 0, '.', '').'|'.$data['penyebab_penurunan']."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileReady_);
        // Add file
        $zip    = "01020101.600420.CR008-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);

    }
    //=================== TXT CR009 ==================//
    function txtcr009($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataCR009($minggu1,$minggu2);
        $namafile   = "01020101.600420.CR009-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.CR009-A.".str_replace("-","",$minggu2).".ready";
        
        $separator  = "|";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namafile);
        header("Content-Disposition: attachment; filename=".$fileready);
        // header file text
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
       

        $file = fopen($namafile,"w");  
        $fileReady_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  
        foreach($temp as $data){
            
            if($data['jenis_agunan'] == "") { $nilaiagunan = "";}else{ $nilaiagunan = number_format($data['nilai_agunan'],0,'.',''); }
            if($data['jenis_kredit'] == "3") { $jeniskredit = "03";}else{ $jeniskredit = $data['jenis_kredit']; }

             //$tanggalKolek = $this->getDateCollect($data['no_rekening'],$minggu1,$minggu2,$data['kualitas_baru']); 
            
            
            $isi = 'D'.'|'.$data['kd_kantor_ojk'].'|'.$data['nama_nasabah'].'|'.
                    $data['no_cif'].'|'.$data['nik'].'|'.$data['kode_kelompok_kredit'].'|'.
                    $data['no_rekening'].'|'.$jeniskredit.'|'.$data['jenis_debitur'].'|'.
                    $data['sektor_ekonomi'].'|'.$data['kategori_usaha'].'|'.number_format($data['suku_bunga'], 2).'|'.
                    $data['perhitungan_suku_bunga'].'|'.$data['jumlah_rekening'].'|'.$data['perubahan_kualitas'].'|'.str_replace("-","",$data['tanggal']).
                    '|'.$data['kualitas_lama'].'|'.$data['kualitas_baru'].'|'.$data['penyebab_kualitas'].'|'.number_format($data['plafond'], 0, '.', '').
                    '|'.number_format($data['baki_debet'], 0, '.', '').
                    '|'.$data['jenis_agunan'].'|'.$nilaiagunan."\r\n";
            fwrite($file,$isi);  
        }
        fclose($file); 
        fclose($fileReady_);
        // Add file
        $zip    = "01020101.600420.CR009-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);

    }
    //=================== TXT OP001 ==================//
    function txtop001($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataOP001($minggu1,$minggu2);
        
        $namafile   = "01020101.600420.OP001-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.OP001-A.".str_replace("-","",$minggu2).".ready";

        $separator  = "|";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namafile);
        header("Content-Disposition: attachment; filename=".$fileready);
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        $file = fopen($namafile,"w");  
        $fileReady_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  
        foreach($temp as $data){
            
            // if($data['nilai_agunan'] == 0) { $nilaiagunan = "";}else{ $nilaiagunan = $data['nilai_agunan']; }
            $isi = 'D'.'|'.$data['kd_kantor_ojk'].'|'.str_replace("-","",$data['tanggal']).'|'.
                    number_format($data['saldo_awal'], 0, '.', '').'|'.number_format($data['debet'],0, '.', '').'|'.number_format($data['kredit'] ,0, '.', '').'|'.
                    number_format($data['saldo_akhir'], 0, '.', '')."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileReady_); 
        // Add file
        $zip    = "01020101.600420.OP001-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);
    }
    //=================== TXT OP002 ==================//
    function txtop002($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataOP002($minggu1,$minggu2);
        $namafile   = "01020101.600420.OP002-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.OP002-A.".str_replace("-","",$minggu2).".ready";

        $separator  = "|";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namafile);
        header("Content-Disposition: attachment; filename=".$fileready);
        // header file text
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        $file = fopen($namafile,"w");  
        $fileready_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  
        
        foreach($temp as $data){
            
            // if($data['nilai_agunan'] == 0) { $nilaiagunan = "";}else{ $nilaiagunan = $data['nilai_agunan']; }
            $isi = 'D'.'|'.$data['no_cif'].'|'.$data['sandi_bank'].'|'.$data['lokasi_bank'].'|'.
                    $data['no_rekening_bank_penempatan'].'|'.$data['jenis'].'|'.
                    number_format($data['saldo_awal'],0, '.', '').'|'.number_format($data['debet'] ,0, '.', '').'|'.
                    number_format($data['kredit'], 0, '.', '').'|'.number_format($data['saldo_akhir'], 0, '.', '')."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileready_); 

        // Add file
        $zip    = "01020101.600420.OP002-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);

    }
    //=================== TXT LQ003 ==================//
    function txtlq003($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataLQ003($minggu1,$minggu2);
        $namafile   = "01020101.600420.LQ003-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.LQ003-A.".str_replace("-","",$minggu2).".ready";

        $separator  = "|";

        header("Content-type: text/plain");
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($namafile));
        header('Content-Disposition: attachment; filename='.basename($fileready));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        $file = fopen($namafile,"w");  
        $fileready_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  

        foreach($temp as $data){
            
            $isi = 'D'.'|'.str_replace("-","",$data['no_cif']).'|'.$data['nama_nasabah'].'|'.$data['no_identitas'].'|'.
                    $data['jenis_dpk'].'|'.number_format($data['nominal'],0,'.','')."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileready_); 

        // Add file
        $zip    = "01020101.600420.LQ003-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);
   

    }
    //=================== TXT LQ004 ==================//
    function txtlq004($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataLQ004($minggu1,$minggu2);
        $namafile   = "01020101.600420.LQ004-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.LQ004-A.".str_replace("-","",$minggu2).".ready";

        $separator  = "|";

        header("Content-type: text/plain");
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($namafile));
        header('Content-Disposition: attachment; filename='.basename($fileready));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        $file = fopen($namafile,"w");  
        $fileready_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  
        
        foreach($temp as $data){
            
            $isi = 'D'.'|'.str_replace("-","",$data['no_cif']).
                    '|'.$data['nama_nasabah'].
                    '|'.$data['no_identitas'].
                    '|'.$data['jenis_dpk'].'|'.
                    number_format($data['nominal'],0,'.','')."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileready_); 
        // Add file
        $zip    = "01020101.600420.LQ004-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);
    

    }

    //=================== TXT LQ005 ==================//
    function txtlq005($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataLQ005($minggu2);
        $namafile   = "01020101.600420.LQ005-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.LQ005-A.".str_replace("-","",$minggu2).".ready";

        $separator  = "|";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namafile);
        header("Content-Disposition: attachment; filename=".$fileready);
        header('Content-Description: File Transfer');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");
        // $this->download($namafile);

        $file = fopen($namafile,"w");  
        $fileready_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  
        foreach($temp as $data){
            
            $isi = 'D'.'|'.str_replace("-","",$data['periode']).'|'.number_format($data['kas'],0,".","").'|'.number_format($data['giro'],0,".","").'|'.
                    number_format($data['selisih'],0,".","").'|'.number_format($data['tab_aba'],0,".","").'|'.number_format($data['tab_bank_abp'],0,".","").'|'.number_format($data['tab_bpr_abp'],0,".","").'|'.
                    number_format($data['jml_likuid'],0,".","").'|'.number_format($data['kewajiban_segera'],0,".","").'|'.number_format($data['tab_dpk'],0,".","").'|'.number_format($data['dep_dpk'],0,".","").'|'.
                    number_format($data['jml_kewajiban'],0,".","").'|'.number_format($data['cash_ratio'],2)."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileready_); 
        // Add file
        $zip    = "01020101.600420.LQ005-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;

        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        return $this->zip->download($zip);
    }

    //=================== TXT LQ006 ==================//
    function txtlq006($minggu1,$minggu2){
        $temp       = $this->Obox_model->getDataLQ006($minggu2);
        $namafile   = "01020101.600420.LQ006-A.".str_replace("-","",$minggu2).".txt";
        $fileready   = "01020101.600420.LQ006-A.".str_replace("-","",$minggu2).".ready";
        $separator  = "|";

        // header file text
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($namafile));
        header('Content-Disposition: attachment; filename='.basename($fileready));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($namafile));
        header('Content-Length: ' . filesize($fileready));
        header("Content-Type: text/plain");

        $file = fopen($namafile,"w");  
        $fileready_ = fopen($fileready,"w");  
        $isiheader  = 'H|01020101|600420|A|'.str_replace("-","",$minggu2).'|'.count($temp)."\r\n";
        fwrite($file,$isiheader);  

        foreach($temp as $data){
            
            $isi = 'D'.'|'.str_replace("-","",$data['periode']).'|'.number_format($data['kyd_bank_lain'],0,'.','').
                    '|'.number_format($data['kyd_nasabah'],0,'.','').'|'.
                    number_format($data['jml_kyd'],0,'.','').'|'.
                    number_format($data['dpk'],0,'.','').'|'.
                    number_format($data['kyd_bi'],0,'.','').'|'.
                    number_format($data['abp_dep'],0,'.','').'|'.
                    number_format($data['abp_kyd'],0,'.','').'|'.
                    number_format($data['abp_bukan_bank'],0,'.','').'|'.
                    number_format($data['abp_modal'],0,'.','').'|'.
                    number_format($data['modal_inti'],0,'.','').'|'.
                    number_format($data['jml_dana'],0,'.','').'|'
                    .number_format($data['ldr'],2)."\r\n";
            fwrite($file,$isi);  
        }
       
        fclose($file); 
        fclose($fileready_); 
        // Add file
        $zip    = "01020101.600420.LQ006-A.".str_replace("-","",$minggu2).".zip";
        $filepath1 = FCPATH.$namafile;
        $filepath2 = FCPATH.$fileready;
        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);
        return $this->zip->download($zip);
    }
    //=================== Get Change Date Collectibility ==================//
    function getDateCollect($norekening,$minggu1,$minggu2,$kualitas_baru){

        $data = $this->Core_model->getChangeDateCollectibility($norekening,$minggu1,$minggu2);
       
        foreach($data as $items){
            
            if($kualitas_baru == $items['my_kolek_number']){
                return $items['tanggal'];
            }
        }

    }

    public function download($fileName = NULL) {   
        if ($fileName) {
            $file = base_url().$fileName;
           
            // check file exists    
            if (file_exists($file)) {
                var_dump("OK");die;
                // get file content
                $data = file_get_contents($file);
                //force download
                force_download($fileName, $data );
            } else {
                // Redirect to base url
                redirect('/');
            }
        }
    }


    public function excelcr006($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Debitur Baru PLafond Terbesar.xls";
        $temp       = $this->Obox_model->getDataCR006($daritgl,$sampaitgl);

        $judul = "Debitur Baru Plafond Terbesar";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "FLag");
        xlsWriteLabel($tablehead, $kolomhead++, "Kantor");
        xlsWriteLabel($tablehead, $kolomhead++, "Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "CIF");
        xlsWriteLabel($tablehead, $kolomhead++, "NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Klmpk Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "Tgl Mulai");
        xlsWriteLabel($tablehead, $kolomhead++, "Jth Tempo");
        xlsWriteLabel($tablehead, $kolomhead++, "Debitur");
        xlsWriteLabel($tablehead, $kolomhead++, "Sektor Ekonomi");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori Usaha");
        xlsWriteLabel($tablehead, $kolomhead++, "Suku Bunga");
        xlsWriteLabel($tablehead, $kolomhead++, "Plafond");
        xlsWriteLabel($tablehead, $kolomhead++, "Plafond Efektif");
        xlsWriteLabel($tablehead, $kolomhead++, "Baki Debet");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Agunan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nilai Agunan");

    
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kantor']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nama_nasabah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_cif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nik']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kelompok_kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_rekening']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['tanggal_mulai']);
            xlsWriteNumber($tablebody, $kolombody++, $data['tanggal_jatuh_tempo']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_debitur']);
            xlsWriteLabel($tablebody, $kolombody++, $data['sektor_ekonomi']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kategori_usaha']);
            xlsWriteLabel($tablebody, $kolombody++, $data['suku_bunga']);
            xlsWriteNumber($tablebody, $kolombody++, $data['perhitungan_suku_bunga']);
            xlsWriteNumber($tablebody, $kolombody++, $data['jml_pinjaman']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_pinjaman_efektif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['baki_debet']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_agunan']);
            xlsWriteNumber($tablebody, $kolombody++, $data['nilai_agunan']);

	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excelcr008($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Debitur Penurunan Baki Debet Terbesar.xls";
        $temp       = $this->Obox_model->getDataCR008($daritgl,$sampaitgl);
       
        $judul = "Debitur Penurunan Baki Debet Terbesar";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "Kantor");
        xlsWriteLabel($tablehead, $kolomhead++, "Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "CIF");
        xlsWriteLabel($tablehead, $kolomhead++, "NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Klmpk Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Debitur");
        xlsWriteLabel($tablehead, $kolomhead++, "Plafond Sebelum");
        xlsWriteLabel($tablehead, $kolomhead++, "Plafond Sesudah");
        xlsWriteLabel($tablehead, $kolomhead++, "Peningkatan Penurunan Plafond");
        xlsWriteLabel($tablehead, $kolomhead++, "Beki Debet Sebelum");
        xlsWriteLabel($tablehead, $kolomhead++, "Beki Debet Sesudah");
        xlsWriteLabel($tablehead, $kolomhead++, "Penurunan Beki Debet");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Rek Sebelum");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Rek Sesudah");
        xlsWriteLabel($tablehead, $kolomhead++, "Penyebab Penurunan");
        
    
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kantor']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nama_nasabah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_cif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nik']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kelompok_kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_rekening']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_debitur']);
            xlsWriteLabel($tablebody, $kolombody++, $data['plafond_sebelum']);
            xlsWriteNumber($tablebody, $kolombody++, $data['plafond_sesudah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['peningkatan_penurunan_plafond']);
            xlsWriteLabel($tablebody, $kolombody++, $data['baki_debet_sebelum']);
            xlsWriteLabel($tablebody, $kolombody++, $data['baki_debet_sesudah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['penurunan_baki_debet']);
            xlsWriteNumber($tablebody, $kolombody++, $data['rek_sebelum']);
            xlsWriteNumber($tablebody, $kolombody++, $data['rek_sesudah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['penyebab_penurunan']);
       

	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excelcr009($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Debitur Perubahan Kualitas Berdasarkan Baki Debet Terbesar.xls";
        $temp       = $this->Obox_model->getDataCR009($daritgl,$sampaitgl);
       
        $judul = "Debitur Perubahan Kualitas Berdasarkan Baki Debet Terbesar";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "Kantor");
        xlsWriteLabel($tablehead, $kolomhead++, "Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "CIF");
        xlsWriteLabel($tablehead, $kolomhead++, "NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Klmpk Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Debitur");
        xlsWriteLabel($tablehead, $kolomhead++, "Sektor Ekonomi");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori Usaha");
        xlsWriteLabel($tablehead, $kolomhead++, "Suku Bunga");
        xlsWriteLabel($tablehead, $kolomhead++, "Perhitungan Suku Bunga");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Perubahan Kualitas");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Perubahan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kualitas Lama");
        xlsWriteLabel($tablehead, $kolomhead++, "Kualitas Baru");
        xlsWriteLabel($tablehead, $kolomhead++, "Penyebab Kualitas");
        xlsWriteLabel($tablehead, $kolomhead++, "Plafond");
        xlsWriteLabel($tablehead, $kolomhead++, "Baki Debet");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Agunan");
        xlsWriteLabel($tablehead, $kolomhead++, "Nilai Agunan");
        
    
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kantor']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nama_nasabah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_cif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nik']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kelompok_kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_rekening']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_debitur']);
            xlsWriteNumber($tablebody, $kolombody++, $data['sektor_ekonomi']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kategori_usaha']);
            xlsWriteLabel($tablebody, $kolombody++, $data['suku_bunga']);
            xlsWriteLabel($tablebody, $kolombody++, $data['perhitungan_suku_bunga']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jumlah_rekening']);
            xlsWriteNumber($tablebody, $kolombody++, $data['perubahan_kualitas']);
            xlsWriteNumber($tablebody, $kolombody++, $data['tanggal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kualitas_lama']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kualitas_baru']);
            xlsWriteLabel($tablebody, $kolombody++, $data['penyebab_kualitas']);
            xlsWriteLabel($tablebody, $kolombody++, $data['plafond']);
            xlsWriteLabel($tablebody, $kolombody++, $data['baki_debet']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_agunan']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nilai_agunan']);       

	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excelop001($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Pemantauan Mutasi Kas Harian.xls";
        $temp       = $this->Obox_model->getDataOP001($daritgl,$sampaitgl);
      
        $judul = "Pemantauan Mutasi Kas Harian";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "Kantor");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
        xlsWriteLabel($tablehead, $kolomhead++, "Saldo Awal");
        xlsWriteLabel($tablehead, $kolomhead++, "Debet");
        xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "Saldo Akhir");
        
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kode_kantor']);
            xlsWriteLabel($tablebody, $kolombody++, $data['tanggal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['saldo_awal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['debet']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['saldo_akhir']);
           
	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excelop002($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Pemantauan Penempatan pada Bank Lain.xls";
        $temp       = $this->Obox_model->getDataOP002($daritgl,$sampaitgl);
        
        $judul      = "Pemantauan Penempatan pada Bank Lain";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "No CIF");
        xlsWriteLabel($tablehead, $kolomhead++, "Sandi Bank");
        xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
        xlsWriteLabel($tablehead, $kolomhead++, "Saldo Awal");
        xlsWriteLabel($tablehead, $kolomhead++, "Debet");
        xlsWriteLabel($tablehead, $kolomhead++, "Kredit");
        xlsWriteLabel($tablehead, $kolomhead++, "Saldo Akhir");
        
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_cif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['sandi_bank']);
            xlsWriteLabel($tablebody, $kolombody++, $data['lokasi_bank']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_rekening_bank_penempatan']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis']);
            xlsWriteLabel($tablebody, $kolombody++, $data['saldo_awal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['debet']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kredit']);
            xlsWriteLabel($tablebody, $kolombody++, $data['saldo_akhir']);
           
	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excellq003($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "10 Nasabah dengan Dana Masuk Terbesar.xls";
        $temp       = $this->Obox_model->getDataLQ003($daritgl,$sampaitgl);
       
        $judul      = "10 Nasabah dengan Dana Masuk Terbesar";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "No CIF");
        xlsWriteLabel($tablehead, $kolomhead++, "Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis DPK/Simpanan Bank Lain");
        xlsWriteLabel($tablehead, $kolomhead++, "Nominal");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Transaksi");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_cif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nama_nasabah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_identitas']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_dpk']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nominal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_rekening']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_trx']);
            xlsWriteLabel($tablebody, $kolombody++, $data['keterangan']);
           
	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excellq004($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "10 Nasabah dengan Dana Keluar Terbesar.xls";
        $temp       = $this->Obox_model->getDataLQ004($daritgl,$sampaitgl);
       
        $judul      = "10 Nasabah dengan Dana Keluar Terbesar";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "No CIF");
        xlsWriteLabel($tablehead, $kolomhead++, "Nasabah");
        xlsWriteLabel($tablehead, $kolomhead++, "NIK");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis DPK/Simpanan Bank Lain");
        xlsWriteLabel($tablehead, $kolomhead++, "Nominal");
        xlsWriteLabel($tablehead, $kolomhead++, "No Rekening");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Transaksi");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_cif']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nama_nasabah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_identitas']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jenis_dpk']);
            xlsWriteLabel($tablebody, $kolombody++, $data['nominal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['no_rekening']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_trx']);
            xlsWriteLabel($tablebody, $kolombody++, $data['keterangan']);
           
	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excellq005($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Pemantauan Cash Ratio Mingguan.xls";
        $temp       = $this->Obox_model->getDataLQ005($sampaitgl);
       
        $judul      = "Pemantauan Cash Ratio Mingguan";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "Periode");
        xlsWriteLabel($tablehead, $kolomhead++, "Kas");
        xlsWriteLabel($tablehead, $kolomhead++, "Giro");
        xlsWriteLabel($tablehead, $kolomhead++, "Selisih");
        xlsWriteLabel($tablehead, $kolomhead++, "Tab ABA");
        xlsWriteLabel($tablehead, $kolomhead++, "Tab Bank ABP");
        xlsWriteLabel($tablehead, $kolomhead++, "Tab BPR ABP");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Likuiq");
        xlsWriteLabel($tablehead, $kolomhead++, "Kewajiban Segera");
        xlsWriteLabel($tablehead, $kolomhead++, "Tabungan DPK");
        xlsWriteLabel($tablehead, $kolomhead++, "Deposito DPK");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Kewajiban");
        xlsWriteLabel($tablehead, $kolomhead++, "Cash Ratio");
        
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['periode']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kas']);
            xlsWriteLabel($tablebody, $kolombody++, $data['giro']);
            xlsWriteLabel($tablebody, $kolombody++, $data['selisih']);
            xlsWriteLabel($tablebody, $kolombody++, $data['tab_aba']);
            xlsWriteLabel($tablebody, $kolombody++, $data['tab_bank_abp']);
            xlsWriteLabel($tablebody, $kolombody++, $data['tab_bpr_abp']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_likuid']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kewajiban_segera']);
            xlsWriteLabel($tablebody, $kolombody++, $data['tab_dpk']);
            xlsWriteLabel($tablebody, $kolombody++, $data['dep_dpk']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_kewajiban']);
            xlsWriteLabel($tablebody, $kolombody++, $data['cash_ratio']);
           
	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function excellq006($periodebefore,$daritgl,$sampaitgl)
    {
        
        $this->load->helper('exportexcel');
        $namaFile = "Pemantauan Loan to Deposit Ratio.xls";
        $temp       = $this->Obox_model->getDataLQ006($sampaitgl);
    //    var_dump($temp);die;
        $judul      = "Pemantauan Loan to Deposit Ratio";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();
       
        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Flag");
        xlsWriteLabel($tablehead, $kolomhead++, "Periode");
        xlsWriteLabel($tablehead, $kolomhead++, "Kredit kpd Bank lain dari 3 Bulan");
        xlsWriteLabel($tablehead, $kolomhead++, "Kredit kpd Pihak Ke 3 Bukan Bank");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Kredit yg diberikan");
        xlsWriteLabel($tablehead, $kolomhead++, "Simpanan Pihak Ketiga");
        xlsWriteLabel($tablehead, $kolomhead++, "Pinjaman Dari Bank Indonesia");
        xlsWriteLabel($tablehead, $kolomhead++, "Deposito dari Bank lain > 3 bln");
        xlsWriteLabel($tablehead, $kolomhead++, "Pinjaman dari Bank lain > 3 bln");
        xlsWriteLabel($tablehead, $kolomhead++, "Pinjaman yg diterima dari pihak ke 3 bukan bank > 3 bln");
        xlsWriteLabel($tablehead, $kolomhead++, "Pinjaman yg dapat diperhitungkan sbg modal inti tambahan s.d 3 bln");
        xlsWriteLabel($tablehead, $kolomhead++, "Modal Inti");
        xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Komponen Dana");
        xlsWriteLabel($tablehead, $kolomhead++, "LDR");
        
        
        foreach($temp as $data){
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data['flag_detail']);
            xlsWriteLabel($tablebody, $kolombody++, $data['periode']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kyd_bank_lain']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kyd_nasabah']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_kyd']);
            xlsWriteLabel($tablebody, $kolombody++, $data['dpk']);
            xlsWriteLabel($tablebody, $kolombody++, $data['kyd_bi']);
            xlsWriteLabel($tablebody, $kolombody++, $data['abp_dep']);
            xlsWriteLabel($tablebody, $kolombody++, $data['abp_kyd']);
            xlsWriteLabel($tablebody, $kolombody++, $data['abp_bukan_bank']);
            xlsWriteLabel($tablebody, $kolombody++, $data['abp_modal']);
            xlsWriteLabel($tablebody, $kolombody++, $data['modal_inti']);
            xlsWriteLabel($tablebody, $kolombody++, $data['jml_dana']);
            xlsWriteLabel($tablebody, $kolombody++, $data['ldr']);
           
	    $tablebody++;
            $nourut++;
        }
       

        xlsEOF();
        exit();
    }

    public function perubahankolek(){
        $data['kolek']="active";
        $data['headerpage']="show";
       

        $this->template->load('template/template','perubahan_kolek/table');
    }

    public function tampilKolek()
    {
        $minggu1                = $this->input->post('daritgl');
        $minggu2                = $this->input->post('sampaitgl');
      
        $start = new DateTime($minggu1);
        $end = new DateTime($minggu2);
        $interval = $start->diff($end);
        $day    = $interval->days+1;
       
        if($day >= 31){
            $data['hasil'] = array();
            $data['message'] = 'Tanggal tidak bisa lebih dari 31 Hari.';
           
        }else{
            $data['message']  = "";
            $data['hasil'] = $this->Obox_model->getDataKolek($minggu1,$minggu2);
           
            if(empty($data['hasil'])){

                $temp      = $this->Core_model->getDataPerubahanKolek($minggu1,$minggu2);
                if(!is_null($temp)){
                
                    foreach($temp as $items){
                    
                        $tanggalKolek = $this->getDateCollect($items['no_rekening'],$minggu1,$minggu2,$items['kolekbaru']); 
                        $input = [
                            'flag_detail' => $items['flag_detail'],
                            'kode_kantor' => $items['kode_kantor'],
                            'nama_nasabah' => $items['nama_nasabah'],
                            'no_cif' => $items['no_cif'],
                            'nik' => $items['nik'],
                            'kode_kelompok_kredit' => $items['kode_kelompok_kredit'],
                            'no_rekening' => $items['no_rekening'],
                            'jenis_kredit' => $items['jenis_kredit'],
                            'jenis_debitur' => $items['jenis_debitur'],
                            'sektor_ekonomi' => $items['sektor_ekonomi'],
                            'kategori_usaha' => $items['kategori_usaha'],
                            'suku_bunga' => $items['suku_bunga'],
                            'perhitungan_suku_bunga' => $items['perhitungan_suku_bunga'],
                            'jumlah_rekening' => $items['jumlah_rekening'],
                            'perubahan_kualitas' => $items['perubahan_kualitas'],
                            'tanggal' => $tanggalKolek,
                            'kualitas_lama' => $items['koleklama'],
                            'kualitas_baru' => $items['kolekbaru'],
                            'penyebab_kualitas' => $items['penyebab_kualitas'],
                            'plafond' => $items['plafond'],
                            'baki_debet' => $items['baki_debet'],
                            'jenis_agunan' => $items['jenis_agunan'],
                            'nilai_agunan' => $items['nilai_agunan'],
                            'daritgl' => $minggu1,
                            'sampaitgl' => $minggu2,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        
                        $result = $this->Obox_model->storeKolek($input);
                    }
                }

                $data['hasil'] = $this->Obox_model->getDataCR009($minggu1,$minggu2);   
            }
        }

       
        $this->load->view('perubahan_kolek/list',$data);
    }



}
