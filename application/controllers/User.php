<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->model('GuruModel');
		$this->load->library('session');
		$this->load->helper('url');
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
	}

	public function index()
	{
		$data['user'] = $this->UserModel->get_all_user();
		$data['guru'] = $this->UserModel->get_guru(); // Ambil data guru
		$data['title'] = 'Data User';
		$data['content_view'] = 'pages/user/index';
		$this->load->view('template/content', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[user.username]');
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('alert', '<div class="alert  alert-danger">Data gagal di tambahkan!</div>');
			$this->session->set_flashdata('alert_timeout', 4000);
			redirect('guru');
		} else {
			$data = array(
				'user_id' => md5(date('YmdHis') . rand(1000, 9999)),
				'username' => $this->input->post('username'),
				'password' => $password,
				'role' => $this->input->post('role'),
				'guru_id' => $this->input->post('guru_id')
			);

			$this->UserModel->insert_user($data);
			$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan!</div>');
			$this->session->set_flashdata('alert_timeout', 4000);
			redirect('user');
		}
	}

	public function update()
	{
		$user_id = $this->input->post('user_id');
		$data = array(
			'role' => $this->input->post('role')
		);

		$this->UserModel->update_user($user_id, $data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di update!</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('user');
	}

	public function delete()
	{
		$user_id = $this->input->post('user_id');
		$this->db->where('user_id', $user_id);
		$this->db->delete('user');
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di hapus!</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('user');
	}
}
