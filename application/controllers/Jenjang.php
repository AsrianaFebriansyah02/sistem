<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenjang extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('JenjangPendidikanModel');
		$this->load->library('session');
		$this->load->helper('url');
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
	}
	public function index()
	{
		$data['title'] = 'Data Jenjang Pendidikan';
		$data['jenjang_pendidikan'] = $this->JenjangPendidikanModel->get_all_jenjang_pendidikan();
		$data['content_view'] = 'pages/jenjang/index';
		$this->load->view('template/content', $data);
		
	}
	public function simpan()
	{
		$data = array(
			'jenjang_pendidikan_id' => md5(date('YmdHis') . rand(1000, 9999)),
			'nama_jenjang_pendidikan' => $this->input->post('nama_jenjang_pendidikan'),
		);

		$this->JenjangPendidikanModel->insert_jenjang_pendidikan($data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('jenjang');
	}
	public function update()
	{
		$jenjang_pendidikan_id = $this->input->post('jenjang_pendidikan_id');
		$data = array(
			'nama_jenjang_pendidikan' => $this->input->post('nama_jenjang_pendidikan'),
		);

		$this->JenjangPendidikanModel->update_jenjang_pendidikan($jenjang_pendidikan_id, $data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di update !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('jenjang');
	}

	public function delete()
	{
		$jenjang_pendidikan_id = $this->input->post('jenjang_pendidikan_id');

		$this->db->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
		$this->db->delete('jenjang_pendidikan');
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di hapus !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('jenjang');
	}
}
