<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Services_model extends CI_Model {
 
    public function __construct()
    {
        $this->load->database();
    }
 
	public function get_services()
	{
	  $query = $this->db->get('services');
	  return $query->result_array();
	}
  
	public function get_services_by_id($id)
	{
	  $query = $this->db->get_where('services', array('id' => $id));
	  return $query->row_array();
	}

	public function add_services($title,$icon,$content, $created_at) {
		$data = array(
		  'title' => $title,
		  'icon' => $icon,
		  'content' => $content,
		  'created_at' => $created_at,
		  'updated_at' => $created_at,
		);
		$this->db->insert('services', $data);
	}

	public function update_services($id, $title,$icon,$content,  $updated_at)
	{
		$data = array(
		'title' => $title,
		'icon' => $icon,
		'content' => $content,
		'updated_at' => $updated_at,
		);
		$this->db->where('id', $id);
		return $this->db->update('services', $data);
	}

	public function delete_services($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('services');
	}

	public function count_project_by_status($status)
	{
		$this->db->where('status', $status);
		$query = $this->db->get('project');
		return $query->num_rows();
	}
}
