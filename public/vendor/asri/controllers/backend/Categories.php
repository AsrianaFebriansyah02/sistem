<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

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
		
        $this->load->model('Categories_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$data['title']='Categories';
		$data['categories'] =$this->Categories_model->get_categories();
		$this->load->view('backend/blogs/categories',$data);
	}

	public function add() {

		$this->form_validation->set_rules('name', 'Categories Name', 'required|trim|is_unique[categories.name]');
		
		if ($this->form_validation->run() === FALSE) {
			 $this->session->set_flashdata('error', 'Data gagal di tambah!');
			 redirect('backend/categories');
		} else {

		  $name = $this->input->post('name');
		  
		  $slug = url_title($name, 'dash', TRUE);
		  $created_at = date('Y-m-d H:i:s');
		  
		  $this->Categories_model->add_categories($name, $slug,$created_at);
		  
		  $this->session->set_flashdata('success', 'Data berhasil di tambah!');
		  redirect('backend/categories');
		}
	}

	public function update($id)
	{
	
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			redirect('backend/categories');
		}
		else
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$slug = url_title($name, 'dash', TRUE);
			$updated_at = date('Y-m-d H:i:s');

			$this->Categories_model->update_categories($id, $name, $slug, $updated_at);
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/categories');
		}
	}
  
	public function delete($id)
	{
	  $this->Categories_model->delete_categories($id);
	  $this->session->set_flashdata('success', 'Data berhasil di hapus!');
	  redirect('backend/categories');
	}
}