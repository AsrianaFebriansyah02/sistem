<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
    {
        parent::__construct();

		$this->load->model('Services_model');
        $this->load->model('SettingModel');
		$this->load->library('session');
		$this->load->helper('url');
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
		
    }

	public function index()
	{
		$data['title']='Dashboard';

		$data['services'] = $this->db->count_all_results('services');
		$data['project'] = $this->db->count_all_results('project');
		$data['visitors'] = $this->db->count_all_results('visitors');
		$data['complete'] = $this->Services_model->count_project_by_status('complete');
		$data['progres']= $this->Services_model->count_project_by_status('progres');
		$data['team'] = $this->db->count_all_results('team');	

		$this->load->model('LogModel');
		$user_id = $this->session->userdata('id');
		$data ['log']= $this->LogModel->getRecentLogsByUserId($user_id, 3);
	
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('backend/dashboard/index',$data);
	}
}
