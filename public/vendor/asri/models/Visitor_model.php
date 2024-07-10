<?php

class Visitor_model extends CI_Model {


	public function save_visitor($ip_address, $user_agent)
	{
			$data = array(
					'ip_address' => $ip_address,
					'user_agent' => $user_agent,
					'visit_time' => date('Y-m-d H:i:s')
			);
			$this->db->insert('visitors', $data);
	}

    public function get_visitor_count_by_date($date) {
      $this->db->select('visitor_count');
      $this->db->from('visitors');
      $this->db->where('date', $date);
      $query = $this->db->get();
      $result = $query->row_array();
      return $result['visitor_count'];
    }
  
    public function add_visitor_count($date) {
      $visitor_count = $this->get_visitor_count_by_date($date);
      if ($visitor_count) {
        $this->db->set('visitor_count', $visitor_count+1);
        $this->db->where('date', $date);
        $this->db->update('visitors');
      } else {
        $data = array(
          'date' => $date,
          'visitor_count' => 1
        );
        $this->db->insert('visitors', $data);
      }
    }
  
    public function get_visitor_count_by_month($month, $year) {
      $this->db->select_sum('visitor_count');
      $this->db->from('visitors');
      $this->db->where('MONTH(date)', $month);
      $this->db->where('YEAR(date)', $year);
      $query = $this->db->get();
      $result = $query->row_array();
      return $result['visitor_count'];
    }
  
    public function get_total_visitor_count() {
      $this->db->select_sum('visitor_count');
      $this->db->from('visitors');
      $query = $this->db->get();
      $result = $query->row_array();
      return $result['visitor_count'];
    }
  
  }
  