<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
		if ($this->session->userdata('level') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            $this->session->set_flashdata('error_timeout', 4000);
            redirect('eror');
        }

		$this->load->library('zip');
		$this->load->helper('url');
        $this->load->model('Backup_history_model');
    }

    public function index()
    {
		$data['title']='Backup History';
        $data['backup_history'] = $this->Backup_history_model->get_all();
        $this->load->view('backend/backup/index', $data);
    }

    public function backup()
    {
        // Buat backup database
        $this->load->dbutil();
        $backup = $this->dbutil->backup();

        // Simpan ke file zip
        $filename = 'Apins_' . date('Y-m-d-H-i-s') . '.sql';
        $filepath = 'backup/' . $filename;
        $this->load->helper('file');
        write_file($filepath, $backup);

        // Simpan riwayat backup ke dalam tabel
        $this->Backup_history_model->create($filename, $filepath);

        // Tampilkan pesan sukses
        $this->session->set_flashdata('success', 'Backup database berhasil dibuat.');
        // Redirect ke halaman index
        redirect('backend/backup');
    }

	public function restoreData($filename) {
        // Mendapatkan path lengkap ke file backup
        $file_path = FCPATH . 'backup/'. $filename;
        
        // Memanggil fungsi restoreData pada model
        $result = $this->restore_model->restoreData($file_path);
        
        if ($result) {
            // Jika restore berhasil, tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data berhasil direstore.');
			redirect('backend/backup');
        } else {
            // Jika restore gagal, tampilkan pesan error
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat melakukan restore data.');
			redirect('backend/backup');
        }
        
		$this->session->set_flashdata('error', 'Backup database gagal dihabus.');
		redirect('backend/backup');
    }

	public function delete($fileId) {

        $this->db->where('id', $fileId);
        $file = $this->db->get('backup_history')->row();

        if ($file) {
            $path = FCPATH . 'backup/' . $file->filename;
            if (file_exists($path)) {
                unlink($path);
            }

            $this->db->where('id', $fileId);
            $this->db->delete('backup_history');
			$this->session->set_flashdata('success', 'Backup database berhasil dihabus.');
            redirect('backend/backup');
        } else {
			$this->session->set_flashdata('error', 'Backup database gagal dihabus.');
            redirect('backend/backup');
        }
    }

}
