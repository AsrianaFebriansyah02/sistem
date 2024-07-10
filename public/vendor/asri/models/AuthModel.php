<?php
class AuthModel extends CI_Model {

    public function create_user($email, $password)
    {
        $data = array(
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'is_active' => 0
        );
        $this->db->insert('users', $data);
    }

	function get_users($table)
	{
		return $this->db->get($table);
	}

    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));
        return $query->row_array();
    }

    public function verify_user($email)
    {
        $this->db->where('email', $email);
        $this->db->update('users', array('is_active' => 1));
    }
}

