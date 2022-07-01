<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->model('Antrian_model');
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}
	}
	public function index()
	{
		
		$this->template->load('template/template','template/beranda');
	}

	public function upload_file()
	{
		$this->load->view('antrian/coba');
	}

	public function well()
	{
		$this->load->view('welcome_message');
		
	}

	function search()
	{
		$output = '';
        $query = '';
        if($this->input->post('nama'))
        {
         $query = $this->input->post('nama');
        }
        if (!$this->ion_auth->in_group('admin', $this->session->userdata("user_id"))) {
            $where=$this->session->userdata("user_id");
        }
  
        $data['data']= $this->Antrian_model->search_data($query,$where)->result();
		$this->template->load('template/template','search', $data);
	}

	
}
