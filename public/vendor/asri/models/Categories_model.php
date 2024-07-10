<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Categories_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
	public function get_categories()
	{
	  $query = $this->db->get('categories');
	  return $query->result_array();
	}
  
	public function get_categories_by_id($id)
	{
	  $query = $this->db->get_where('categories', array('id' => $id));
	  return $query->row_array();
	}

	public function add_categories($name, $slug, $created_at) {
		$data = array(
		  'name' => $name,
		  'slug' => $slug,
		  'created_at' => $created_at,
		  'updated_at' => $created_at,
		);
		$this->db->insert('categories', $data);
	}

	public function update_categories($id, $name, $slug, $updated_at)
	{
		$data = array(
		'name' => $name,
		'slug' => $slug,
		'updated_at' => $updated_at,
		);
		$this->db->where('id', $id);
		return $this->db->update('categories', $data);
	}

	public function delete_categories($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('categories');
	}
}
