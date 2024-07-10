<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
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
		
        $this->load->model('SettingModel');
        $this->load->helper('form');
    }

	public function index()
	{
		$data['title']='Setting Aplikasi';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('backend/setting/index',$data);
	}
	public function update()
	{		
		$this->form_validation->set_rules('id', 'ID', 'required');

        if ($this->form_validation->run() != false) {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $alamat = $this->input->post('alamat');
            $about = $this->input->post('about');
            $link_youtube = $this->input->post('link_youtube');
            $link_ig = $this->input->post('link_ig');
            $link_fb = $this->input->post('link_fb');
            $link_twitter = $this->input->post('link_twitter');
            $map = $this->input->post('map');

            $where = array(
                'id' => $id
            );
            $data = array(
                'nama' => $nama,
                'email' => $email,
                'phone' => $phone,
                'alamat' => $alamat,
                'about' => $about,
                'link_youtube' => $link_youtube,
                'link_ig' => $link_ig,
                'link_fb' => $link_fb,
                'link_twitter' => $link_twitter,
                'map' => $map,
            );

            $this->SettingModel->update_data($where, $data, 'setting');
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/setting');
        }
	}

    public function update_logo($id) {

        // Konfigurasi upload file
        $config['upload_path'] = './uploads/logo/'; // Direktori penyimpanan file
        $config['allowed_types'] = 'jpg|png|jpeg'; // Jenis file yang diperbolehkan
        $config['max_size'] = 400; // Ukuran maksimal file dalam 400 kilobita
        $config['encrypt_name'] = TRUE; // Mengenkripsi nama file

        $this->load->library('upload', $config); // Load library upload dengan konfigurasi di atas

        if ($this->upload->do_upload('logo')) { // Jika upload berhasil
            $upload_data = $this->upload->data(); // Data file yang diupload

            // Data yang akan diupdate dalam database
            $file_data = array(
                'logo' => $upload_data['file_name'],
            );

            // Hapus file yang sudah ada sebelumnya
            $old_file = $this->SettingModel->get_file($id); // Ambil data file lama
            unlink('./uploads/logo/'.$old_file['logo']); // Hapus file lama dari direktori

            // Update data file dalam database
            $this->SettingModel->update_file($id, $file_data);

            $this->session->set_flashdata('success', 'Logo berhasil di update!');
            redirect('backend/setting');
        } else {
            // Jika upload gagal, tampilkan pesan error
			$this->session->set_flashdata('error', 'Logo gagal di di update!');
            redirect('backend/setting');
        }
    }

    public function upload() {
        if ($this->input->post('submit')) {
            // Proses validasi form, misalnya menggunakan form validation library

            // Konfigurasi upload file
            $config['upload_path'] = './uploads/'; // Sesuaikan dengan path untuk menyimpan file Anda
            $config['allowed_types'] = 'gif|jpg|png'; // Sesuaikan dengan tipe file yang diizinkan
            // $config['max_size'] = 2048; // Sesuaikan dengan ukuran file maksimum yang diizinkan (dalam KB)

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('logo')) {
                // Jika upload gagal, tampilkan pesan error
                $error = array('error' => $this->upload->display_errors());
                redirect('backend/setting', $error);
            } else {
                // Jika upload berhasil, simpan data file ke database
                $upload_data = $this->upload->data();
                $file_data = array(
                    'logo' => $upload_data['file_name'],
                    // ...
                );
                $this->SettingModel->insert_file($file_data);

                // Redirect atau tampilkan pesan sukses
                $this->session->set_flashdata('gagal', 'Data setting berhasil <b>di update</b>');
                $this->session->set_flashdata('alert_timeout', 2000);
                redirect('backend/setting');
            }

        } else {
            redirect('backend/setting');
        }
    }

}
