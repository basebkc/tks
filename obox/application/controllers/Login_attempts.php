<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_attempts extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Login_attempts_model');
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
        $login_attempts = $this->Login_attempts_model->get_all();

        $data = array(
            'login_attempts_data' => $login_attempts
        );

        $this->template->load('template/template','login_attempts/login_attempts_list', $data);
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
        $row = $this->Login_attempts_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ip_address' => $row->ip_address,
		'login' => $row->login,
		'time' => $row->time,
	    );
            $this->template->load('template/template','login_attempts/login_attempts_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login_attempts'));
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
            'action' => site_url('login_attempts/create_action'),
	    'id' => set_value('id'),
	    'ip_address' => set_value('ip_address'),
	    'login' => set_value('login'),
	    'time' => set_value('time'),
	);
        $this->template->load('template/template','login_attempts/login_attempts_form', $data);
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
		'ip_address' => $this->input->post('ip_address',TRUE),
		'login' => $this->input->post('login',TRUE),
		'time' => $this->input->post('time',TRUE),
	    );

            $this->Login_attempts_model->insert($data);
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
        $row = $this->Login_attempts_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('login_attempts/update_action'),
		'id' => set_value('id', $row->id),
		'ip_address' => set_value('ip_address', $row->ip_address),
		'login' => set_value('login', $row->login),
		'time' => set_value('time', $row->time),
	    );
            $this->template->load('template/template','login_attempts/login_attempts_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login_attempts'));
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
		'ip_address' => $this->input->post('ip_address',TRUE),
		'login' => $this->input->post('login',TRUE),
		'time' => $this->input->post('time',TRUE),
	    );

            $this->Login_attempts_model->update($this->input->post('id', TRUE), $data);
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
        $row = $this->Login_attempts_model->get_by_id($kode);

        if ($row) {
            $this->Login_attempts_model->delete($kode);
            $pesan = 'Data berhasil dihapus';
           $msg = array('sukses'=>$pesan);
           echo json_encode($msg);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login_attempts'));
        }
    }
}
    public function _rules()
    {
	$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
	$this->form_validation->set_rules('login', 'login', 'trim|required');
	$this->form_validation->set_rules('time', 'time', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Login_attempts.php */
/* Location: ./application/controllers/Login_attempts.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-03-21 04:29:08 */
/* http://harviacode.com */