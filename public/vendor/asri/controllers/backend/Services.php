<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services extends CI_Controller {

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
		
        $this->load->model('Services_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$data['title']='Services';
		$data['services'] =$this->Services_model->get_services();
		$this->load->view('backend/services/index',$data);
	}

	public function add() {

		$this->form_validation->set_rules('title', 'services title', 'required|trim|is_unique[services.title]');
		
		if ($this->form_validation->run() === FALSE) {
			 $this->session->set_flashdata('error', 'Data gagal di tambah!');
			 redirect('backend/services');
		} else {

		  $title = $this->input->post('title');
		  $icon = $this->input->post('icon');
		  $content = $this->input->post('content');
		  $created_at = date('Y-m-d H:i:s');
		  
		  $this->Services_model->add_services($title,$icon,$content, $created_at);
		  
		  $this->session->set_flashdata('success', 'Data berhasil di tambah!');
		  redirect('backend/services');
		}
	}

	public function update($id)
	{
	
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('title', 'title', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			redirect('backend/services');
		}
		else
		{
			$title = $this->input->post('title');
			$icon = $this->input->post('icon');
			$content = $this->input->post('content');
			$updated_at = date('Y-m-d H:i:s');

			$this->Services_model->update_services($id, $title,$icon,$content,  $updated_at);
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/services');
		}
	}
  
	public function delete($id)
	{
	  $this->Services_model->delete_services($id);
	  $this->session->set_flashdata('success', 'Data berhasil di hapus!');
	  redirect('backend/services');
	}
}
