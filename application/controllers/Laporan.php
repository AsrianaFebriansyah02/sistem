<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
		$data['title'] = 'Data Laporan';
		$data['jenjang_pendidikan'] = $this->TransaksiModel->get_all_jenjang_pendidikan();
		$data['tahun_ajaran'] = $this->TransaksiModel->get_all_tahun_ajaran();
		$data['transaksi'] = $this->TransaksiModel->get_all_transaksi();
		$data['saldo'] = $this->TransaksiModel->get_saldo();

		$data['content_view'] = 'pages/laporan/index';
		$this->load->view('template/content', $data);
	
		}
	}
	}

	public function cetak()
	{
		$data['transaksi'] = $this->TransaksiModel->get_all_transaksi();
		$data['saldo'] = $this->TransaksiModel->get_saldo();
		$data['tahun_ajaran'] = $this->TransaksiModel->get_all_tahun_ajaran();
		$data['jenjang_pendidikan'] = $this->TransaksiModel->get_all_jenjang_pendidikan();
		$data['title'] = 'Data Transaksi';
		$this->load->view('pages/laporan/cetak', $data);
	}
}
