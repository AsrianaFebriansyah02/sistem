<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Posts extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SettingModel');
        $this->load->model('posts_model');
        $this->load->model('comments_model');
        $this->load->model('Categories_model');
        $this->load->model('tags_model');
        $this->load->library('form_validation');
    }
 
    public function index()
    {
        $data['posts'] = $this->posts_model->get_posts();
        $data['title']='Blogs Post';
		$data['setting'] =$this->SettingModel->get_all_setting();
		$data['categories'] =$this->Categories_model->get_categories();
		$data['tags'] = $this->tags_model->get_tags();
		$this->load->view('backend/blogs/index',$data);
    }
 
    public function view($id)
    {
        $data['post'] = $this->posts_model->get_post($id);
        $data['comments'];
        $data['comment_count'] = $this->comments_model->get_comment_count($id);
        $data['categories'] = $this->categories_model->get_categories();
        $data['tags'] = $this->tags_model->get_tags();
        $this->load->view('posts/view', $data);
    }
 
    public function create()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('tags[]', 'Tags', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $data['categories'] = $this->categories_model->get_categories();
            $data['tags'] = $this->tags_model->get_tags();
            $this->load->view('posts/create', $data);
        }
        else
        {
            $data = array(
                'title' => $this->input->post('title'),
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                'user_id' => 1 // replace with your user id
            );
 
            $post_id = $this->posts_model->create_post($data);
            $tags = $this->input->post('tags');
            $this->tags_model->create_tags($tags, $post_id);
            redirect('posts');
        }
    }
 
    public function edit($id)
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('body', 'Body', 'required');
        $this->form_validation->set_rules('category_id', 'Category', 'required');
        $this->form_validation->set_rules('tags[]', 'Tags', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $data['post'] = $this->posts_model->get_post($id);
            $data['categories'] = $this->categories_model->get_categories();
            $data['tags'] = $this->tags_model->get_tags();
            $this->load->view('posts/edit', $data);
        }
        else
        {
            $data = array(
                'title' => $this->input->post('title'),
                'body' => $this->input->post('body'),
                'category_id' => $this->input->post('category_id'),
                'slug' => url_title($this->input->post('title'), 'dash', TRUE),
                'user_id' => 1 // replace with your user id
            );
 
            $this->posts_model->update_post($id, $data);
            $tags = $this->input->post('tags');
            $this->tags_model->update_tags($tags, $id);
            redirect('posts');
        }
    }
 
    public function delete($id)
    {
        $this->posts_model->delete_post($id);
        redirect('posts');
    }
}

