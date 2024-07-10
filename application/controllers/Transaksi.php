<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('TransaksiModel');
		$this->load->library('session');
		$this->load->helper('url');
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
	}

	public function index()
	{
		$data['transaksi'] = $this->TransaksiModel->get_all_transaksi();
		$data['saldo'] = $this->TransaksiModel->get_saldo();
		// $data['tahun_ajaran'] = $this->TransaksiModel->get_tahun_ajaran();
		$data['user'] = $this->TransaksiModel->get_user();
		$data['title'] = 'Data Transaksi';
		$data['content_view'] = 'pages/transaksi/index';
		$this->load->view('template/content', $data);
	}

	public function simpan()
	{
		$data = array(
			'transaksi_id' => md5(date('YmdHis') . rand(1000, 9999)),
			'tanggal' => $this->input->post('tanggal'),
			'uraian' => $this->input->post('uraian'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'nominal' => $this->input->post('nominal'),
			'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id'),
			'user_id' => $this->input->post('user_id'),
		);

		$this->TransaksiModel->insert_transaksi($data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('transaksi');
	}
	public function update()
	{
		$transaksi_id = $this->input->post('transaksi_id');
		$data = array(
			'transaksi_id' => md5(date('YmdHis') . rand(1000, 9999)),
			'tanggal' => $this->input->post('tanggal'),
			'uraian' => $this->input->post('uraian'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'nominal' => $this->input->post('nominal'),
			'tahun_ajaran_id' => $this->input->post('tahun_ajaran_id'),
			'user_id' => $this->input->post('user_id'),
		);

		$this->TransaksiModel->update_transaksi($transaksi_id, $data);
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di update !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('transaksi');
	}

	public function delete()
	{
		$transaksi_id = $this->input->post('transaksi_id');
		$this->db->where('transaksi_id', $transaksi_id);
		$this->db->delete('transaksi');
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di hapus !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('transaksi');
	}
}
