<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content_view'] = 'pages/index';
		$this->load->view('template/content', $data);
		
	}
	public function add()
	{
		$data['content_view'] = 'pages/add';
		$this->load->view('template/content', $data);
	}
}
