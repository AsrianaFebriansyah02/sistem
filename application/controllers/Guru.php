<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('GuruModel');
		// $this->load->library('session');
		// $this->load->helper('url');
		// if ($this->session->userdata('status') != "telah_login") {
		// 	redirect(base_url() . 'login?alert=belum_login');
		// }
	}
	public function index()
	{
		$data['title'] = 'Data Guru';
		$data['guru'] = $this->GuruModel->get_all_guru();
		$data['jenjang_pendidikan'] = $this->GuruModel->get_jenjang_pendidikan(); // Ambil data jenjang pendidikan
		$data['content_view'] = 'pages/guru/index';
		$this->load->view('template/content', $data);
	}
	public function simpan()
	{
		$data = array(
			'guru_id' => md5(date('YmdHis') . rand(1000, 9999)),
			'nama_guru' => $this->input->post('nama_guru'),
			'status' => $this->input->post('status'),
			'niy_guru' => $this->input->post('niy_guru'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'jabatan' => $this->input->post('jabatan'),
			'jenjang_pendidikan_id' => $this->input->post('jenjang_pendidikan_id'),
		);

		$this->GuruModel->insert_guru($data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('guru');
	}
	public function update()
	{
		$guru_id = $this->input->post('guru_id');
		$data = array(
			'nama_guru' => $this->input->post('nama_guru'),
			'niy_guru' => $this->input->post('niy_guru'),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'alamat' => $this->input->post('alamat'),
			'jabatan' => $this->input->post('jabatan'),
			'status' => $this->input->post('status'),
			'jenjang_pendidikan_id' => $this->input->post('jenjang_pendidikan_id')
		);

		$this->GuruModel->update_guru($guru_id, $data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di update !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('guru');
	}


	public function delete()
	{

		$guru_id = $this->input->post('guru_id');

		$this->db->where('guru_id', $guru_id);
		$this->db->delete('guru');
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di hapus !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('guru');
	}
}
