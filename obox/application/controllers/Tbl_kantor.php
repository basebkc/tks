<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_kantor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_kantor_model');
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
        $tbl_kantor = $this->Tbl_kantor_model->get_all();

        $data = array(
            'tbl_kantor_data' => $tbl_kantor,
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'data_kantor_active' => 'active'
        );

        $this->template->load('template/template','tbl_kantor/tbl_kantor_list', $data);
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
        $row = $this->Tbl_kantor_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kan' => $row->id_kan,
		'kd_kan' => $row->kd_kan,
		'id_ljk' => $row->id_ljk,
		'n_kan' => $row->n_kan,
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'data_kantor_active' => 'active'
	    );
            $this->template->load('template/template','tbl_kantor/tbl_kantor_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_kantor'));
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
            'action' => site_url('tbl_kantor/create_action'),
	    'id_kan' => set_value('id_kan'),
	    'kd_kan' => set_value('kd_kan'),
	    'id_ljk' => set_value('id_ljk'),
	    'n_kan' => set_value('n_kan'),
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'data_kantor_active' => 'active'
	);
        $this->template->load('template/template','tbl_kantor/tbl_kantor_form', $data);
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
		'kd_kan' => $this->input->post('kd_kan',TRUE),
		'id_ljk' => $this->input->post('id_ljk',TRUE),
		'n_kan' => $this->input->post('n_kan',TRUE),
	    );

            $this->Tbl_kantor_model->insert($data);
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
        $row = $this->Tbl_kantor_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_kantor/update_action'),
		'id_kan' => set_value('id_kan', $row->id_kan),
		'kd_kan' => set_value('kd_kan', $row->kd_kan),
		'id_ljk' => set_value('id_ljk', $row->id_ljk),
		'n_kan' => set_value('n_kan', $row->n_kan),
            'data_master_active' => 'active',
            'data_master_show' => 'show',
            'data_kantor_active' => 'active'
	    );
            $this->template->load('template/template','tbl_kantor/tbl_kantor_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_kantor'));
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
            $this->update($this->input->post('id_kan', TRUE));
        } else {
            $data = array(
		'kd_kan' => $this->input->post('kd_kan',TRUE),
		'id_ljk' => $this->input->post('id_ljk',TRUE),
		'n_kan' => $this->input->post('n_kan',TRUE),
	    );

            $this->Tbl_kantor_model->update($this->input->post('id_kan', TRUE), $data);
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
        $row = $this->Tbl_kantor_model->get_by_id($kode);

        if ($row) {
            $this->Tbl_kantor_model->delete($kode);
            $pesan = 'Data berhasil dihapus';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_kantor'));
        }
    }
}
    public function _rules()
    {
	$this->form_validation->set_rules('kd_kan', 'kd kan', 'trim|required');
	$this->form_validation->set_rules('id_ljk', 'kd jenis ljk', 'trim|required');
	$this->form_validation->set_rules('n_kan', 'n kan', 'trim|required');

	$this->form_validation->set_rules('id_kan', 'id_kan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_kantor.xls";
        $judul = "tbl_kantor";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Kan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Jenis Ljk");
	xlsWriteLabel($tablehead, $kolomhead++, "N Kan");

	foreach ($this->Tbl_kantor_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_kan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_ljk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->n_kan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_kantor.doc");

        $data = array(
            'tbl_kantor_data' => $this->Tbl_kantor_model->get_all(),
            'start' => 0
        );

        $this->load->view('tbl_kantor/tbl_kantor_doc',$data);
    }

}

/* End of file Tbl_kantor.php */
/* Location: ./application/controllers/Tbl_kantor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-21 06:31:59 */
/* http://harviacode.com */