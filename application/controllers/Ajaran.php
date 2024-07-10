<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TahunAjaranModel');
        // $this->load->library('session');
        // $this->load->helper('url');
        // if ($this->session->set_userdata('status') != "telah_login") {
        //     redirect(base_url() . 'login?alert=belum_login');
        // }
    }

    public function index()
    {
        $data['title'] = 'Data Tahun Ajaran';
        $data['tahun_ajaran'] = $this->TahunAjaranModel->get_all_tahun_ajaran();
        $data['content_view'] = 'pages/ajaran/index';
        $this->load->view('template/content', $data);
    }

    public function simpan()
    {
        $data = array(
            'tahun_ajaran_id' => md5(date('YmdHis') . rand(1000, 9999)),
            'nama_tahun' => $this->input->post('nama_tahun'),
            'status' => $this->input->post('status'),
        );

        $this->TahunAjaranModel->insert_tahun_ajaran($data);
        $this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan !</div>');
        $this->session->set_flashdata('alert_timeout', 4000);
        redirect('ajaran');
    }
    public function update()
    {
        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');
        $data = array(
            'nama_tahun' => $this->input->post('nama_tahun'),
            'status' => $this->input->post('status'),
        );

        $this->TahunAjaranModel->update_tahun_ajaran($tahun_ajaran_id, $data);
        $this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di update !</div>');
        $this->session->set_flashdata('alert_timeout', 4000);
        redirect('ajaran');
    }

    public function delete()
    {

        $tahun_ajaran_id = $this->input->post('tahun_ajaran_id');

        $this->db->where('tahun_ajaran_id', $tahun_ajaran_id);
        $this->db->delete('tahun_ajaran');
        $this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di hapus !</div>');
        $this->session->set_flashdata('alert_timeout', 4000);
        redirect('ajaran');
    }
}