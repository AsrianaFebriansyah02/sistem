<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Teknologi_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
	public function get_teknologi()
	{
	  $query = $this->db->get('teknologi');
	  return $query->result_array();
	}
  
	public function get_teknologi_by_id($id)
	{
	  $query = $this->db->get_where('teknologi', array('id' => $id));
	  return $query->row_array();
	}

	public function add_teknologi($name, $created_at) {
		$data = array(
		  'name' => $name,
		  'created_at' => $created_at,
		  'updated_at' => $created_at,
		);
		$this->db->insert('teknologi', $data);
	}

	public function update_teknologi($id, $name,  $updated_at)
	{
		$data = array(
		'name' => $name,
		'updated_at' => $updated_at,
		);
		$this->db->where('id', $id);
		return $this->db->update('teknologi', $data);
	}

	public function delete_teknologi($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('teknologi');
	}
}
