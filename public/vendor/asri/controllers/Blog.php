<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
    }

	public function index()
	{
		$data['title']='All Blog';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('frontend/blog/blog',$data);
	}
	public function detail()
	{
		$data['title']='All Blog';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$this->load->view('frontend/blog/blog-detail',$data);
	}

	public function cari() {
		$data = array();
		$keyword = $this->input->get('q');
	  
		if ($keyword) {
		  $this->load->model('Blog_model');
		  $data['results'] = $this->Blog_model->search($keyword);
		  $view = $this->load->view('hasil_pencarian_ajax', $data, true); // Render view hasil pencarian sebagai string
		  $this->output->set_content_type('application/json')->set_output(json_encode(array('html' => $view))); // Kembalikan hasil pencarian dalam format JSON
		}
	  }
	  
}
