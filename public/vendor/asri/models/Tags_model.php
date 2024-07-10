<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Tags_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
    public function get_tags()
    {
        $this->db->order_by('name');
        $query = $this->db->get('tags');
        return $query->result_array();
    }
 
    public function add_tags($name, $slug, $created_at) {
		$data = array(
		  'name' => $name,
		  'slug' => $slug,
		  'created_at' => $created_at,
		  'updated_at' => $created_at,
		);
		$this->db->insert('tags', $data);
	}

	public function update_tags($id, $name, $slug, $updated_at)
	{
		$data = array(
		'name' => $name,
		'slug' => $slug,
		'updated_at' => $updated_at,
		);
		$this->db->where('id', $id);
		return $this->db->update('tags', $data);
	}

	public function delete_tags($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('tags');
	}
	
    public function get_post_tags($post_id)
    {
        $this->db->select('tags.name');
        $this->db->from('post_tags');
        $this->db->join('tags', 'post_tags.tag_id = tags.id');
        $this->db->where('post_tags.post_id', $post_id);
        $query = $this->db->get();
        return $query->result_array();
    }
 
    public function get_tag_id($tag_name)
    {
        $this->db->where('name', $tag_name);
        $query = $this->db->get('tags');
        $result = $query->row_array();
 
        if ($result)
        {
            return $result['id'];
        }
        else
        {
            $data = array(
                'name' => $tag_name
            );
 
            $this->db->insert('tags', $data);
            return $this->db->insert_id();
        }
    }
 
    public function create_post_tags($post_id, $tag_ids)
    {
        $data = array();
 
        foreach ($tag_ids as $tag_id)
        {
            $data[] = array(
                'post_id' => $post_id,
                'tag_id' => $tag_id
            );
        }
 
        $this->db->insert_batch('post_tags', $data);
    }
}
