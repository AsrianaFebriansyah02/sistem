<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogActivity extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

		$this->load->model('LogModel');
		$this->load->model('SettingModel');

		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
		if ($this->session->userdata('level') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            $this->session->set_flashdata('error_timeout', 4000);
            redirect('eror');
        }

    }

	public function index()
	{
		$data['title']='Log Activity';
		$data['setting'] =$this->SettingModel->get_all_setting();

		$this->load->model('LogModel');
		$user_id = $this->session->userdata('id');
		$data ['log']= $this->LogModel->getLogsByUserId($user_id);
	
		$this->load->view('backend/logactivity/index',$data);
	}

	public function deleteAllLogsByUser()
	{				
		$user_id = $this->session->userdata('id');
		
		// Hapus semua log activity berdasarkan user_id
		$this->LogModel->deleteLogsByUserId($user_id);
		
		// Redirect atau berikan pesan sukses
		$this->session->set_flashdata('success', 'Data berhasil di hapus!');
		redirect('backend/logactivity');
	}

}
