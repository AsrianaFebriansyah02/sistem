<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }

	public function index()
	{
		$data['title']='Register';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('frontend/auth/register',$data);
	}
}
