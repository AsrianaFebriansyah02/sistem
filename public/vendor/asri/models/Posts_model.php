<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Posts_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
    public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE)
    {
        if ($limit)
        {
            $this->db->limit($limit, $offset);
        }
 
        if ($slug === FALSE)
        {
            $this->db->order_by('posts.id', 'DESC');
            $this->db->join('categories', 'categories.id = posts.category_id');
            $query = $this->db->get('posts');
            return $query->result_array();
        }
 
        $query = $this->db->get_where('posts', array('slug' => $slug));
        return $query->row_array();
    }
 
    public function create_post($data)
    {
        $this->db->insert('posts', $data);
        return $this->db->insert_id();
    }
 
    public function update_post($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('posts', $data);
    }
 
    public function delete_post($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('posts');
    }
}
