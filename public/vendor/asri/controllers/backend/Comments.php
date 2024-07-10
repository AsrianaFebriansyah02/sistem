<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Comments extends CI_Controller {
 
    public function create($post_id)
    {
        $this->load->model('Comment_model');
 
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('body', 'Comment', 'required');
 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->model('post_model');
            $data['post'] = $this->post_model->get_posts($post_id);
            $data['comments'] = $this->Comment_model->get_comments($post_id);
            $this->load->view('comments', $data);
        }
        else
        {
            $this->Comment_model->create_comment($post_id);
            $this->session->set_flashdata('comment_added', 'Your comment has been added.');
            redirect('posts/view/' . $post_id);
        }
    }
 
}
