<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends CI_Controller {

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
		
        $this->load->model('tags_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$data['title']='Tags';
		$data['tags'] =$this->tags_model->get_tags();
		$this->load->view('backend/blogs/tags',$data);
	}

	public function add() {

		$this->form_validation->set_rules('name', 'tags Name', 'required|trim|is_unique[tags.name]');
		
		if ($this->form_validation->run() === FALSE) {
			 $this->session->set_flashdata('error', 'Data gagal di tambah!');
			 redirect('backend/tags');
		} else {

		  $name = $this->input->post('name');
		  
		  $slug = url_title($name, 'dash', TRUE);
		  $created_at = date('Y-m-d H:i:s');
		  
		  $this->tags_model->add_tags($name, $slug, $created_at);
		  
		  $this->session->set_flashdata('success', 'Data berhasil di tambah!');
		  redirect('backend/tags');
		}
	}

	public function update($id)
	{
	
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			redirect('backend/tags');
		}
		else
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$slug = url_title($name, 'dash', TRUE);
			$updated_at = date('Y-m-d H:i:s');

			$this->tags_model->update_tags($id, $name, $slug, $updated_at);
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/tags');
		}
	}
  
	public function delete($id)
	{
	  $this->tags_model->delete_tags($id);
	  $this->session->set_flashdata('success', 'Data berhasil di hapus!');
	  redirect('backend/tags');
	}
}
