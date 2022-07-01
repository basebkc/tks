<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_ljk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jenis_ljk_model');
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
        $jenis_ljk = $this->Jenis_ljk_model->get_all();

        $data = array(
            'jenis_ljk_data' => $jenis_ljk,
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'jenis_ljk_active' => 'active'
        );

        $this->template->load('template/template','jenis_ljk/jenis_ljk_list', $data);
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
        $row = $this->Jenis_ljk_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'kode' => $row->kode,
		'nama_ljk' => $row->nama_ljk,
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'jenis_ljk_active' => 'active'
	    );
            $this->template->load('template/template','jenis_ljk/jenis_ljk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_ljk'));
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
            'action' => site_url('jenis_ljk/create_action'),
	    'id' => set_value('id'),
	    'kode' => set_value('kode'),
	    'nama_ljk' => set_value('nama_ljk'),
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'jenis_ljk_active' => 'active'
	);
        $this->template->load('template/template','jenis_ljk/jenis_ljk_form', $data);
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
		'kode' => $this->input->post('kode',TRUE),
		'nama_ljk' => $this->input->post('nama_ljk',TRUE),
	    );

            $this->Jenis_ljk_model->insert($data);
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
        $row = $this->Jenis_ljk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_ljk/update_action'),
		'id' => set_value('id', $row->id),
		'kode' => set_value('kode', $row->kode),
		'nama_ljk' => set_value('nama_ljk', $row->nama_ljk),
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'jenis_ljk_active' => 'active'
	    );
            $this->template->load('template/template','jenis_ljk/jenis_ljk_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_ljk'));
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
		'kode' => $this->input->post('kode',TRUE),
		'nama_ljk' => $this->input->post('nama_ljk',TRUE),
	    );

            $this->Jenis_ljk_model->update($this->input->post('id', TRUE), $data);
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
        $row = $this->Jenis_ljk_model->get_by_id($kode);

        if ($row) {
            $this->Jenis_ljk_model->delete($kode);
            $pesan = 'Data berhasil dihapus';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jenis_ljk'));
        }
    }
}
    public function _rules()
    {
	$this->form_validation->set_rules('kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('nama_ljk', 'nama ljk', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "jenis_ljk.xls";
        $judul = "jenis_ljk";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ljk");

	foreach ($this->Jenis_ljk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ljk);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=jenis_ljk.doc");

        $data = array(
            'jenis_ljk_data' => $this->Jenis_ljk_model->get_all(),
            'start' => 0
        );

        $this->load->view('jenis_ljk/jenis_ljk_doc',$data);
    }

}

/* End of file Jenis_ljk.php */
/* Location: ./application/controllers/Jenis_ljk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-21 04:47:39 */
/* http://harviacode.com */