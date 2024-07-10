<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }

	public function index()
	{
		$data['title']='All Project';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('frontend/project/project',$data);
	}

	public function detail()
	{
		$data['title']='detail Project';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('frontend/project/detail-project',$data);
	}
}