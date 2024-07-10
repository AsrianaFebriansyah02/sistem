<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BackupData extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Backup Data';
		$this->load->model('Backup_history_model');

		$data['backup_history'] = $this->Backup_history_model->get_all();

		$data['content_view'] = 'pages/backupdata/index';
		$this->load->view('template/content', $data);
		
	}
	public function add()
	{
		$data['content_view'] = 'pages/add';
		$this->load->view('template/content', $data);
	}
	public function backup()
	{

		$this->load->model('Backup_history_model');

		$this->load->library('zip');
		$this->load->helper('url');
		// Buat backup database
		$this->load->dbutil();
		$backup = $this->dbutil->backup();

		// Simpan ke file zip
		$backup_id = md5(date('YmdHis') . rand(1000, 9999));
		$filename = 'Asriana_' . date('Y-m-d-H-i-s') . '.sql';
		$filepath = 'backup/' . $filename;
		$this->load->helper('file');
		write_file($filepath, $backup);

		// Simpan riwayat backup ke dalam tabel
		$this->Backup_history_model->create($filename, $filepath, $backup_id);

		// Tampilkan pesan sukses
		$this->session->set_flashdata('success', 'Backup database berhasil dibuat.');
		// Redirect ke halaman index
		redirect('backupdata');
	}
	public function delete()
	{

		$backup_id = $this->input->post('backup_id');

		$this->db->where('backup_id', $backup_id);
		$this->db->delete('backup_history');
		$this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di hapus !</div>');
		$this->session->set_flashdata('alert_timeout', 4000);
		redirect('backupdata');
	}
}
