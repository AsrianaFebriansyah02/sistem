<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Jobdesk_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
	public function get_jobdesk()
	{
	  $query = $this->db->get('jobdesk');
	  return $query->result_array();
	}
  
	public function get_jobdesk_by_id($id)
	{
	  $query = $this->db->get_where('jobdesk', array('id' => $id));
	  return $query->row_array();
	}

	public function add_jobdesk($name, $created_at) {
		$data = array(
		  'name' => $name,
		  'created_at' => $created_at,
		  'updated_at' => $created_at,
		);
		$this->db->insert('jobdesk', $data);
	}

	public function update_jobdesk($id, $name,  $updated_at)
	{
		$data = array(
		'name' => $name,
		'updated_at' => $updated_at,
		);
		$this->db->where('id', $id);
		return $this->db->update('jobdesk', $data);
	}

	public function delete_jobdesk($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('jobdesk');
	}
}
