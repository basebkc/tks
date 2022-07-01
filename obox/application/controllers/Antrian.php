<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Antrian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Antrian_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }


        function search($id="")
    {
        $output = '';
        $query = '';
        if($this->input->post('query'))
        {
         $query = $this->input->post('query');
        }
        if ($id=="") {
            $where=$this->session->userdata("user_id");
        }else{
            $where=$id;
        }

        $data = $this->Antrian_model->search_data($query,$where);
        $output .= ' ';
        if($data->num_rows() > 0)
        {
            $no=1;
            foreach($data->result() as $antrian)
            {
                $output .= '
                     <table style="margin-top: 15px;font-size: 13px" width="100%" class="table-bordered ">
                    <tr>
                      <td style="padding-left: 8px;border-right: 0" colspan="3">'. username($antrian->id_user) .' / '. peran_pengguna_user($antrian->id_user) .'</td>
                      <td style="border-left: 0;padding-right: 8px"  align="right">'. nama_kantor($antrian->id_kan ).'</td>
                    </tr>
                    <tr style="background-color: #e3e6f06b;">
                      <td width="25%" style="padding-left: 8px">Kode Ref.</td>
                      <td style="padding-left: 8px">No Identitas</td>
                      <td style="padding-left: 8px">Nama Lengkap  </td>
                      <td style="padding-left: 8px">Tempat Lahir</td>
                    </tr>
                    <tr>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px"><b>'. $antrian->no_antrian .'</b></td>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px">'. $antrian->no_ktp .'</td>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px">'. $antrian->nama .'</td>
                      <td style="padding-left: 8px;padding-top: 5px;padding-bottom: 5px">'. $antrian->tempat_lahir .'</td>
                    </tr>
                    <tr>
                      <td style="background-color: #e3e6f06b;padding-left: 8px">Tanggal Lahir</td>
                      <td style="padding-left: 8px" colspan="2">'. tgl_indo($antrian->tgl_lahir) .'</td>
                      <td rowspan="2" width="25%" style="background-color: #e3e6f06b" align="center">
                          <div style="padding: 5px" class="hidden-sm hidden-xs action-buttons">';
                               if ($antrian->file=="https://drive.google.com/file/d//view"){

                               }else{


                    $output .= '<a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" target="_blank" href="'. $antrian->file .'" class="btn btn-warning  btn-sm" title="Lihat" >
                                <i class="fas fa-download"></i></a>';
                           }

                    $output .= '<a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" href="'. site_url('antrian/read/'.$antrian->id_antrian) .'" class="btn btn-info  btn-sm" title="Lihat" >
                                <i class="fas fa-search-plus"></i></a>
                             <a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" href="'. site_url('antrian/update/'.$antrian->id_antrian) .'" class="btn btn-success  btn-sm" title="Edit" >
                                <i class="fas fa-edit"></i></a>

                             <a style="padding-top: 0px;padding-bottom: 0px;padding-right: 15px;padding-left: 15px;" href="#" class="btn btn-danger  btn-sm" title="Hapus" onclick="return hapusantrian('. $antrian->id_antrian .');">
                                <i class="fas fa-trash"></i></a>
                            </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="background-color: #e3e6f06b;padding-left: 8px">Tanggal Upload</td>
                      <td style="padding-left: 8px" colspan="2">'. tgl_indo($antrian->tgl_upload)  .'</td>

                    </tr>
                  </table>
                ';
            }
        }
        else
        {
            $output .= '<tr>
                            <td colspan="8">No Data Found</td>
                        </tr>';
        }
        echo $output;
    }

    public function index()
    {
        if (!$this->ion_auth->in_group('admin', $this->session->userdata("user_id"))) {
            $this->db->where(array('id_user' => $this->session->userdata("user_id")));
            $tot=$this->db->get('antrian')->num_rows();
        }else{
            $tot=$this->db->get('antrian')->num_rows();
          //konfigurasi pagination
        }
        $config['base_url'] = site_url('antrian/index'); //site url
        $config['total_rows'] =  $tot; //total row
        $config['per_page'] = 12;
        $config['uri_segment'] = 3;
        $config['num_links'] = 3;

        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination2 pagination-sm m-t-xs m-b-xs">';
        $config['full_tag_close']  = '</ul>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = ' <lable>Next</lable> ';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = ' <lable>Prev</lable> ';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li ><a class="active2" href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

    $this->pagination->initialize($config); // Set konfigurasi paginationnya

    $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;

    $data['limit'] = $config['per_page'];
    $data['total_rows'] = $config['total_rows'];
    $data['pagination'] = $this->pagination->create_links();
    $data['antrian_data'] = $this->Antrian_model->get_byuser($this->session->userdata("user_id"),$config["per_page"], $page);

            $data['data_antrian_active']="active";
        $this->template->load('template/template','antrian/antrian_list', $data);
    }

    public function read($id)
    {
        $row = $this->Antrian_model->get_by_id($id);
        if ($row) {
            $data = array(
                    		'id_antrian' => $row->id_antrian,
                    		'nama' => $row->nama,
                    		'no_ktp' => $row->no_ktp,
                    		'tempat_lahir' => $row->tempat_lahir,
                    		'tgl_lahir' => $row->tgl_lahir,
                    		'file' => $row->file,
                    		'id_user' => $row->id_user,
                    		'tgl_upload' => $row->tgl_upload,
                    	    );
            $this->template->load('template/template','antrian/antrian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('antrian'));
        }
    }


    public function create()
    {
                $data['sukses']="";
                $data['input_antrian_active']="active";
                $this->template->load('template/template','antrian/input_antrian',$data);

    }

    public function input_antrian_batch()
    {
      $data['sukses']="";
      $data['input_antrian_batch_active']="active";
      $this->template->load('template/template','antrian/input_antrian_batch',$data);

    }

    public function create_batch_action()
    {
        $no_ktp = $_POST['no_ktp'];
        $id_kan = get_id_kan($this->session->userdata('user_id'));

        $id_group = nama_batch();
        foreach ($no_ktp as $key) {
            $data = array(
                'no_ktp' => $key,
                'no_antrian' => no_antrian(),
                'id_group' => $id_group,
                'id_user' => $this->session->userdata('user_id'),
                'id_kan' => $id_kan,
                'tgl_upload' => date('Y-m-d'),
            );
            $this->Antrian_model->insert($data);
        }
        $namaFile = $id_group.".txt";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namaFile);

        $this->db->where('id_group', $id_group);
        $data = $this->db->get('antrian')->result();
        foreach($data as $key){
            //SENGAJA DI ENTER
            echo  substr(str_replace('.','-',$key->no_antrian),14).'|03|I|'.$key->no_ktp.'
' ;
        }
        // $data['sukses']="";
        // $data['input_antrian_active']="active";
        // $this->template->load('template/template','antrian/input_antrian',$data);

    }

    public function rekap_batch()
    {
        $id_group = $this->input->post('id_group');
        $namaFile = $id_group.".txt";

        header("Content-type: text/plain");
        header("Content-Disposition: attachment; filename=".$namaFile);

        $this->db->where('id_group', $id_group);
        $data = $this->db->get('antrian')->result();
        foreach($data as $key){
            //SENGAJA DI ENTER
            echo  substr(str_replace('.','-',$key->no_antrian),14).'|03|I|'.$key->no_ktp.'
' ;
        }
    }


    public function create_action()
    {

        $this->_rules();

        // $this->load->helper('mycache');
        $var = $this->input->post('LINK');
        cache_save($var);

        if ($this->form_validation->run() == FALSE) {

              $data = array(
                        'nama' => set_value('nama', $this->input->post('nama')),
                        'no_ktp' => set_value('no_ktp', $this->input->post('no_ktp')),
                        'tempat_lahir' => set_value('tempat_lahir', $this->input->post('tempat_lahir')),
                        'tgl_lahir' => set_value('tgl_lahir', $this->input->post('tgl_lahir'))
                        );
            $data['error']='<div  class="text-center">
            <img style="margin-bottom:4%" width="50%" src="'. base_url("assets/images/undraw_posting_photo.svg").'">
            <h3>Data Tidak Lengkap!</h3>
          </div>';
          if (!$this->input->post('nama')) {$data['val_nama']="Data Tidak Boleh Kosong";}
          if (!$this->input->post('no_ktp')) {$data['val_no_ktp']="Data Tidak Boleh Kosong";}
          if (!$this->input->post('tempat_lahir')) {$data['val_tempat_lahir']="Data Tidak Boleh Kosong";}
          if (!$this->input->post('tgl_lahir')) {$data['val_tgl_lahir']="Data Tidak Boleh Kosong";}

            $data['sukses']="";
            $data['button']="";
            $data['input_antrian_active']="active";
            $this->template->load('template/template','antrian/input_antrian',$data);

        } else {
            $jsonText = $this->input->post('getRes');
            $decodedText = html_entity_decode($jsonText);
            $myArray = json_decode($decodedText, true);
            $id_foto = $myArray['id'];

            $no_antrian = no_antrian();
            $data = array(
                        'nama' => $this->input->post('nama',TRUE),
                		'no_antrian' => $no_antrian,
                		'no_ktp' => $this->input->post('no_ktp',TRUE),
                		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
                		'file' => 'https://drive.google.com/file/d/'.$id_foto.'/view',
                        'id_user' => $this->session->userdata('user_id'),
                		'id_kan' => get_id_kan($this->session->userdata('user_id')),
                		'tgl_upload' => date('Y-m-d'),
                	    );

            $this->Antrian_model->insert($data);
            $data['tgl_lahir_v']=date('d-m-Y', strtotime($this->input->post('tgl_lahir',TRUE)));
            $data['age']=$this->input->post('umur',TRUE);
            $data['sukses']=$no_antrian;
            $data['button']="";
            $data['input_antrian_active']="active";
            $this->template->load('template/template','antrian/input_antrian',$data);
        }
    }

    public function update($id)
    {
        $row = $this->Antrian_model->get_by_id($id);
        if ($row) {
        $today = date("Y-m-d");
       $tgl = substr($row->tgl_lahir,8);
       $bln = substr($row->tgl_lahir,-5,-3);
       $thn = substr($row->tgl_lahir,0,-6);
       $birthday = date($row->tgl_lahir);
       $year = 1;

       $birt = $today - $birthday - $year;
       $age=$birt." Tahun";

            $tgl = substr($row->tgl_lahir,8);
            $bln = substr($row->tgl_lahir,-5,-3);
            $thn = substr($row->tgl_lahir,0,-6);
            $tgl_lahir_v = $tgl.$bln.$thn;
            $data = array(
                        'button' => 'Update',
                        'action' => site_url('antrian/update_action'),
                        'id_antrian' => set_value('id_antrian', $row->id_antrian),
                		'no_antrian' => set_value('no_antrian', $row->no_antrian),
                		'nama' => set_value('nama', $row->nama),
                		'no_ktp' => set_value('no_ktp', $row->no_ktp),
                		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
                        'tgl_lahir_v' => set_value('tgl_lahir_v', $tgl_lahir_v),
                        'age' => set_value('age', $age),
                		'file' => set_value('file', $row->file),
                		'id_user' => set_value('id_user', $row->id_user),
                		'tgl_upload' => set_value('tgl_upload', $row->tgl_upload),
                	    );
            $this->template->load('template/template','antrian/input_antrian', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('antrian'));
        }
    }

    public function update_action()
    {

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_antrian', TRUE));
        } else {
            if (empty($this->input->post('file_lama'))) {
                $foto=$this->input->post('file',TRUE);
            }else{
                $foto=$this->input->post('file_lama',TRUE);
            }
            $data = array(
                    		'nama' => $this->input->post('nama',TRUE),
                    		'no_ktp' => $this->input->post('no_ktp',TRUE),
                    		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
                    		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
                    		'file' => $foto,
                    	    );

            $this->Antrian_model->update($this->input->post('id_antrian', TRUE), $data);
            redirect('antrian','refresh');
        }
    }

    public function histori($id)
    {

        $tot=$this->db->where('id_user',$id)->get('antrian')->num_rows();

        $config['base_url'] = site_url('antrian/histori/'.$id); //site url
        $config['total_rows'] =  $tot; //total row
        $config['per_page'] = 12;
        $config['uri_segment'] = 4;
        $config['num_links'] = 3;

        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination2 pagination-sm m-t-xs m-b-xs">';
        $config['full_tag_close']  = '</ul>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = ' <lable>Next</lable> ';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = ' <lable>Prev</lable> ';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li ><a class="active2" href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

    $this->pagination->initialize($config); // Set konfigurasi paginationnya

    $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;

    $data['limit'] = $config['per_page'];
    $data['total_rows'] = $config['total_rows'];
    $data['pagination'] = $this->pagination->create_links();
    $data['id_user'] =  $id;
    $data['antrian_data'] = $this->Antrian_model->get_histori_by_user($id,$config["per_page"], $page);

        $this->template->load('template/template','antrian/histori_byusers', $data);
    }

    public function delete()
    {

         $kode = $this->input->post('kode',true);
        $row = $this->Antrian_model->get_by_id($kode);

        if ($row) {
            $this->Antrian_model->delete($kode);
            $pesan = 'Data berhasil dihapus';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('antrian'));
        }
    }

    public function rekap_data($tgl_awal2="",$tgl_akhir2="",$cabang2="",$users2="",$uri="")
    {

        $output = '';
        $tgl_awal = '';
        $tgl_akhir = '';
        $cabang = '';

         if($this->input->post('tgl_awal') != ""){
         $tgl_awal = $this->input->post('tgl_awal');
        }else{
        $tgl_awal = $tgl_awal2;
        }

        if($this->input->post('tgl_akhir') != ""){
         $tgl_akhir = $this->input->post('tgl_akhir');
        }else{
        $tgl_akhir = $tgl_akhir2;
        }

        if($this->input->post('company') != ""){
         $cabang = $this->input->post('company');
        }else{
        $cabang = $cabang2;
        }

        if($this->input->post('users') != ""){
         $users = $this->input->post('users');
        }else{
        $users = $users2;
        }

        $tgl_awal3=empty($tgl_awal)?"kosong":$tgl_awal;
        $tgl_akhir3=empty($tgl_akhir)?"kosong":$tgl_akhir;
        $cabang3=empty($cabang)?"kosong":$cabang;
        $users3=empty($users)?"kosong":$users;


        $tot=$this->Antrian_model->search_rekap($tgl_awal3,$tgl_akhir3,$cabang3,$users3,"","","1")->num_rows();
        $config['base_url'] = site_url('antrian/rekap_data/'.$tgl_awal3."/".$tgl_akhir3."/".$cabang3."/".$users3); //site url
        $config['total_rows'] =  $tot; //total row
        $config['per_page'] = 12;
        $config['uri_segment'] = 7;
        $config['num_links'] = 3;

        // Style Pagination
        // Agar bisa mengganti stylenya sesuai class2 yg ada di bootstrap
        $config['full_tag_open']   = '<ul class="pagination2 pagination-sm m-t-xs m-b-xs">';
        $config['full_tag_close']  = '</ul>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']       = 'Last';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';

        $config['next_link']       = ' <lable>next</lable> ';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';

        $config['prev_link']       = ' <lable>prev</lable> ';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';

        $config['cur_tag_open']    = '<li ><a class="active2" href="#">';
        $config['cur_tag_close']   = '</a></li>';

        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        // End style pagination

    $this->pagination->initialize($config); // Set konfigurasi paginationnya

    $page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;

    $data['limit'] = $config['per_page'];
    $data['total_rows'] = $config['total_rows'];
    $data['pagination'] = $this->pagination->create_links();
    $data['antrian_data'] = $this->Antrian_model->search_rekap($tgl_awal3,$tgl_akhir3,$cabang3,$users3,$config["per_page"], $page,"0")->result();
    $data['daftar_visible'] = "visible";
    $data['tot'] = $tot;
    $data['tgl_awal']=$tgl_awal;
    $data['tgl_akhir']=$tgl_akhir;
    $data['company_nama']= company($cabang);
    $data['company']= $cabang;
    $data['users_nama']= username($users);
    $data['users']= $users;
    $data['data_antrian_active']="active";
    $data['cetak']="<a class='btn btn-secondary btn-sm'
                    href='".site_url('antrian/rekap_excel/'.$tgl_awal3.'/'.$tgl_akhir3.'/'.$cabang3.'/'.$users3)."'><i class='fa fa-file-excel'></i> Excel</a>&nbsp;&nbsp;";
    //echo json_encode($data['rekap_data']);
    $this->template->load('template/template','antrian/antrian_list', $data);
    }

    function rekap($id="")
    {
        $output = '';
        $tgl_awal = '';
        $tgl_akhir = '';
        $cabang = '';
        if($this->input->post('tgl_awal'))
        {
         $tgl_awal = $this->input->post('tgl_awal');
        }

        if($this->input->post('tgl_akhir'))
        {
         $tgl_akhir = $this->input->post('tgl_akhir');
        }

         if($this->input->post('cabang'))
        {
         $cabang = $this->input->post('cabang');
        }

        if ($id=="") {
            $where=$this->session->userdata("user_id");
        }else{
            $where=$id;
        }

        $data = $this->Antrian_model->search_rekap($tgl_awal,$tgl_akhir,$cabang);
        $output .= ' <table class="table-bordered table-striped">
                  <thead>
                    <tr>
                      <td width="15%"> Kode Ref.</td>
                      <td>No Identitas</td>
                      <td>Nama Lengkap</td>
                      <td>Tempat Lahir</td>
                      <td>Tanggal Lahir</td>
                      <td>Tanggal Upload</td>
                      <td>Aksi</td>
                    </tr>
                  </thead>
                  <tbody> ';
        if($data->num_rows() > 0)
        {
            $no=1;
            foreach($data->result() as $antrian)
            {
                $output .= '
                 <tr>
                  <td><b>'.$antrian->no_antrian.'</b></td>
                  <td>'. $antrian->no_ktp.' </td>
                  <td>'. $antrian->nama.'</td>
                  <td>'. $antrian->tempat_lahir.'</td>
                  <td>'. tgl_indo($antrian->tgl_lahir).'</td>
                  <td>'. tgl_indo($antrian->tgl_upload) .'</td>
                  <td>
                       <div style="margin-top: 4%" class="hidden-sm hidden-xs action-buttons">';
                        if ($antrian->file=="https://drive.google.com/file/d//view"){

                         }else{


                $output .= '<a target="_blank" href="'.$antrian->file.'" class="btn btn-warning btn-circle btn-sm" title="Lihat" >
                                <i class="fas fa-download"></i></a>';
                         }

                $output .= '<a href="'.site_url('antrian/read/'.$antrian->id_antrian).'" class="btn btn-info btn-circle btn-sm" title="Lihat" >
                                <i class="fas fa-search-plus"></i></a>

                             <a href="'.site_url('antrian/update/'.$antrian->id_antrian).'" class="btn btn-success btn-circle btn-sm" title="Edit" >
                                <i class="fas fa-edit"></i></a>

                             <a href="#" class="btn btn-danger btn-circle btn-sm" title="Hapus" onclick="return hapusantrian('.$antrian->id_antrian.');">
                                <i class="fas fa-trash"></i></a>
                            </div>
                  </td>
                </tr>
                ';
            }
        }
        else
        {
            $output .= '<tr>
                            <td colspan="8">No Data Found</td>
                        </tr>';
        }
        $output .= '</tbody>
                </table>';
        echo $output;
    }

    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('no_ktp', 'no ktp', 'trim');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');

	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function rekap_excel($tgl_awal="",$tgl_akhir="",$cabang="",$users="")
    {
        $this->load->helper('exportexcel');
        $namaFile = "Rekap_iDeb.xls";
        $judul = "Rekap_iDeb";
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
    xlsWriteLabel($tablehead, $kolomhead++, "No Antrian");
    xlsWriteLabel($tablehead, $kolomhead++, "Cabang");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama User");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
    xlsWriteLabel($tablehead, $kolomhead++, "No Ktp");
    xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
    xlsWriteLabel($tablehead, $kolomhead++, "File");
    xlsWriteLabel($tablehead, $kolomhead++, "Tgl Upload");

    foreach ($this->Antrian_model->search_rekap($tgl_awal,$tgl_akhir,$cabang,$users)->result() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->no_antrian);
        xlsWriteLabel($tablebody, $kolombody++, cabang($data->id_kan));
        xlsWriteLabel($tablebody, $kolombody++, username2($data->id_user));
        xlsWriteLabel($tablebody, $kolombody++, $data->nama);
        xlsWriteLabel($tablebody, $kolombody++, $data->no_ktp);
        xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
        xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
        xlsWriteLabel($tablebody, $kolombody++, $data->file);
        xlsWriteLabel($tablebody, $kolombody++, $data->tgl_upload);

        $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "Rekap_iDeb.xls";
        $judul = "Rekap_iDeb";
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
    xlsWriteLabel($tablehead, $kolomhead++, "No Antrian");
    xlsWriteLabel($tablehead, $kolomhead++, "Cabang");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama User");
    xlsWriteLabel($tablehead, $kolomhead++, "Nama Nasabah");
	xlsWriteLabel($tablehead, $kolomhead++, "No Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "File");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Upload");

	foreach ($this->Antrian_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->no_antrian);
        xlsWriteLabel($tablebody, $kolombody++, cabang($data->id_kan));
        xlsWriteLabel($tablebody, $kolombody++, username2($data->id_user));
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->file);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_upload);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=antrian.doc");

        $data = array(
            'antrian_data' => $this->Antrian_model->get_all(),
            'start' => 0
        );

        $this->load->view('antrian/antrian_doc',$data);
    }

}
