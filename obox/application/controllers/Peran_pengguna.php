<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peran_pengguna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Peran_pengguna_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
        $peran_pengguna = $this->Peran_pengguna_model->get_all();

        $data = array(
            'peran_pengguna_data' => $peran_pengguna,
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'peran_pengguna_active' => 'active'
        );

        $this->template->load('template/template','peran_pengguna/peran_pengguna_list', $data);
    }
    }

    public function read($id)
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
        $row = $this->Peran_pengguna_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'peran_pengguna_active' => 'active'
	    );
            $this->template->load('template/template','peran_pengguna/peran_pengguna_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peran_pengguna'));
        }
    }
}

    public function create()
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
        $data = array(
            'button' => 'Create',
            'action' => site_url('peran_pengguna/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'peran_pengguna_active' => 'active'
	);
        $this->template->load('template/template','peran_pengguna/peran_pengguna_form', $data);
    }
}

    public function create_action()
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            
           $pesan = '<div class="alart alart-danger"><strong>'.validation_errors().'</strong></div>';
           $msg = array('validasi'=>$pesan);
           echo json_encode($msg);
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Peran_pengguna_model->insert($data);
            $pesan = 'Data berhasil disimpan';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        }
    }
}
    public function update($id)
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
        $row = $this->Peran_pengguna_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('peran_pengguna/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'peran_pengguna_active' => 'active'
	    );
            $this->template->load('template/template','peran_pengguna/peran_pengguna_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peran_pengguna'));
        }
    }
}
    public function update_action()
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->Peran_pengguna_model->update($this->input->post('id', TRUE), $data);
             $pesan = 'Data Berhasil di-Update';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        }
    }
}
    public function delete()
    {
         if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
         $kode = $this->input->post('kode',true);
        $row = $this->Peran_pengguna_model->get_by_id($kode);

        if ($row) {
            $this->Peran_pengguna_model->delete($kode);
            $pesan = 'Data berhasil dihapus';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('peran_pengguna'));
        }
    }
}
    public function _rules()
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "peran_pengguna.xls";
        $judul = "peran_pengguna";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");

	foreach ($this->Peran_pengguna_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=peran_pengguna.doc");

        $data = array(
            'peran_pengguna_data' => $this->Peran_pengguna_model->get_all(),
            'start' => 0
        );

        $this->load->view('peran_pengguna/peran_pengguna_doc',$data);
    }

}

/* End of file Peran_pengguna.php */
/* Location: ./application/controllers/Peran_pengguna.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-21 04:47:51 */
/* http://harviacode.com */