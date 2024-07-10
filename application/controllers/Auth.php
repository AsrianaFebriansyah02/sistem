<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('AuthModel');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['title'] = 'Backup Data';
		$this->load->view('auth/login', $data);
	}

	public function proses_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('AuthModel');
		$user = $this->AuthModel->verify_user($username, $password);
		if ($user) {
			// Set user_id dan role di sesi
			$this->session->set_userdata('user_id', $user->user_id);
			$this->session->set_userdata('role', $user->role);

			$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan!</div>');
			$this->session->set_flashdata('alert_timeout', 4000);
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('alert', '<div class="alert  alert-danger">Username atau password salah!</div>');
			$this->session->set_flashdata('alert_timeout', 4000);
			redirect('auth');
		}
	}

	public function logout()
	{
		// Destroy session data
		$this->session->sess_destroy();

		// Redirect to login page or any desired page
		redirect('login?alert=logout');
	}
}
