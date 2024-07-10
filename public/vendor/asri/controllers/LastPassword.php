<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LastPassword extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }

	public function index()
	{
		$data['title']='Last Password';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('frontend/auth/lastpassword',$data);
	}
}
