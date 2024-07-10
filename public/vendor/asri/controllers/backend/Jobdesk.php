<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobdesk extends CI_Controller {

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
		
        $this->load->model('Jobdesk_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$data['title']='Jobdesk';
		$data['jobdesk'] =$this->Jobdesk_model->get_jobdesk();
		$this->load->view('backend/jobdesk/index',$data);
	}

	public function add() {

		$this->form_validation->set_rules('name', 'jobdesk Name', 'required|trim|is_unique[jobdesk.name]');
		
		if ($this->form_validation->run() === FALSE) {
			 $this->session->set_flashdata('error', 'Data gagal di tambah!');
			 redirect('backend/jobdesk');
		} else {

		  $name = $this->input->post('name');
		  
		  $created_at = date('Y-m-d H:i:s');
		  
		  $this->Jobdesk_model->add_jobdesk($name, $created_at);
		  
		  $this->session->set_flashdata('success', 'Data berhasil di tambah!');
		  redirect('backend/jobdesk');
		}
	}

	public function update($id)
	{
	
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			redirect('backend/jobdesk');
		}
		else
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$updated_at = date('Y-m-d H:i:s');

			$this->Jobdesk_model->update_jobdesk($id, $name, $updated_at);
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/jobdesk');
		}
	}
  
	public function delete($id)
	{
	  $this->Jobdesk_model->delete_jobdesk($id);
	  $this->session->set_flashdata('success', 'Data berhasil di hapus!');
	  redirect('backend/jobdesk');
	}
}
