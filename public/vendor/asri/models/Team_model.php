<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Team_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
	public function get_team()
	{
	  $query = $this->db->get('team');
	  return $query->result_array();
	}
  
	public function get_team_by_id($id)
	{
	  $query = $this->db->get_where('team', array('id' => $id));
	  return $query->row_array();
	}

	public function add_team($name, $job, $created_at) {
		$data = array(
		  'name' => $name,
		  'job' => $job ,
		  'created_at' => $created_at,
		  'updated_at' => $created_at,
		);
		$this->db->insert('team', $data);
	}

	public function update_team($id, $name, $job,  $updated_at)
	{
		$data = array(
		'name' => $name,
		'job' => $job ,
		'updated_at' => $updated_at,
		);
		$this->db->where('id', $id);
		return $this->db->update('team', $data);
	}

	public function delete_team($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('team');
	}
}
