<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_Controller {

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
		
        $this->load->model('Team_model');
		$this->load->model('Jobdesk_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
    }

	public function index()
	{
		$data['title']='Team';
		$data['team'] = $this->Team_model->get_Team();
		$data['jobdesk'] =$this->Jobdesk_model->get_jobdesk();
		$this->load->view('backend/team/index',$data);
	}

	public function add() {

		$this->form_validation->set_rules('name', 'team Name', 'required|trim|is_unique[team.name]');
		$this->form_validation->set_rules('job', 'team job', 'required');
		
		if ($this->form_validation->run() === FALSE) {
			 $this->session->set_flashdata('error', 'Data gagal di tambah!');
			 redirect('backend/team');
		} else {

		  $name = $this->input->post('name');
		  $job = $this->input->post('job');
		  
		  $created_at = date('Y-m-d H:i:s');
		  
		  $this->Team_model->add_team($name, $job, $created_at);
		  
		  $this->session->set_flashdata('success', 'Data berhasil di tambah!');
		  redirect('backend/team');
		}
	}

	public function update($id)
	{
	
		$this->form_validation->set_rules('id', 'Id', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() === FALSE)
		{
			redirect('backend/team');
		}
		else
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			$job = $this->input->post('job');
			$updated_at = date('Y-m-d H:i:s');

			$this->Team_model->update_team($id, $name, $job, $updated_at);
			$this->session->set_flashdata('success', 'Data berhasil di update!');
			redirect('backend/team');
		}
	}
  
	public function delete($id)
	{
	  $this->Team_model->delete_team($id);
	  $this->session->set_flashdata('success', 'Data berhasil di hapus!');
	  redirect('backend/team');
	}
}
