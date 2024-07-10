<?php

class LogModel extends CI_Model
{
	public function __construct()
    {
        $this->load->database();
    }

    public function logActivity($user_id, $activity)
    {
        $data = array(
            'user_id' => $user_id,
            'activity' => $activity,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('log_activity', $data);
    }

    public function getAllLogs()
    {
        $this->db->order_by('created_at', 'desc');
        return $this->db->get('log_activity')->result();
    }

	public function getLogsByUserId($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get('log_activity');
        return $query->result_array();
    }

	public function getRecentLogsByUserId($user_id, $limit)
	{
		$this->db->where('user_id', $user_id);
		$this->db->order_by('created_at', 'desc');
		$this->db->limit($limit);
		$query = $this->db->get('log_activity');
		return $query->result_array();
	}


	public function deleteLogsByUserId($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('log_activity');
	}

}
