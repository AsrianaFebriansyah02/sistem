<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teknologi extends CI_Controller {

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
        $this->load->model('Teknologi_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$data['title']='Teknologi';
		$data['teknologi'] =$this->Teknologi_model->get_teknologi();
		$this->load->view('backend/teknologi/index',$data);
	}

	public function add() {

		$this->form_validation->set_rules('name', 'teknologi Name', 'required|trim|is_unique[teknologi.name]');
		
		if ($this->form_validation->run() === FALSE) {
			 $this->session->set_flashdata('error', 'Data gagal di tambah!');
			 redirect('backend/teknologi');
		} else {

		  $name = $this->input->post('name');
		  $created_at = date('Y-m-d H:i:s');
		  
		  $this->Teknologi_model->add_teknologi($name, $created_at);
		  
		  $this->session->set_flashdata('success', 'Data berhasil di tambah!');
		  redirect('backend/teknologi');
		}
	}

	public function update($id)
	{
	
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			redirect('backend/teknologi');
		}
		else
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$updated_at = date('Y-m-d H:i:s');

			$this->Teknologi_model->update_teknologi($id, $name, $updated_at);
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/teknologi');
		}
	}
  
	public function delete($id)
	{
	  $this->Teknologi_model->delete_teknologi($id);
	  $this->session->set_flashdata('success', 'Data berhasil di hapus!');
	  redirect('backend/teknologi');
	}
}
