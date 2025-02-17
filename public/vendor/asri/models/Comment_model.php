<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Comment_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
    public function create_comment($post_id)
    {
        $data = array(
            'post_id' => $post_id,
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'body' => $this->input->post('body')
        );
 
        return $this->db->insert('comments', $data);
    }
 
    public function get_comments($post_id)
    {
        $this->db->order_by('created_at', 'ASC');
        $query = $this->db->get_where('comments', array('post_id' => $post_id));
        return $query->result_array();
    }
 
}
