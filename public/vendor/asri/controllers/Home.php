<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
		$this->load->model('Services_model');
    }

	public function index()
	{
		$this->hit_counter();
		
		$data['title']='Home';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$data['services'] =$this->Services_model->get_services();
		$this->load->view('frontend/template/content',$data);
	}
	public function comingsoon()
	{
		$data['title']='Home';
		$this->load->view('frontend/comingsoon',$data);
	}
	
	public function hit_counter()
	{
		$this->load->library('session');

		// Periksa apakah session pengunjung sudah tersedia
		if (!$this->session->userdata('hit_counter')) {
			// Jika tidak, tambahkan session pengunjung dan tambah jumlah pengunjung
			$this->session->set_userdata('hit_counter', true);

			// Tambah jumlah pengunjung
			$this->increase_visitor_count();
		}
	}

	private function increase_visitor_count()
	{
		$this->load->library('user_agent');
		$this->load->model('Visitor_model');

		// Ambil informasi pengunjung
		$ip_address = $this->input->ip_address();
		$user_agent = $this->agent->agent_string();

		// Simpan pengunjung ke dalam database
		$this->Visitor_model->save_visitor($ip_address, $user_agent);
	}

}
