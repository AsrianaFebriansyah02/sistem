<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }

	public function index()
	{

		$email = $this->session->set_userdata('email');

		$this->load->model('AuthModel');
		$profile = $this->AuthModel->get_user_by_email($email);

		$data['profile'] = $profile;
		$data['title']='Profile';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('backend/Profile/index',$data);
	}
}
