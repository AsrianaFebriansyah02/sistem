<?php
class AuthModel extends CI_Model
{

    public function create_user($username, $password)
    {
        $data = array(
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        );
        $this->db->insert('user', $data);
    }

    function get_user($table)
    {
        return $this->db->get($table);
    }

    public function get_user_by_username($username)
    {
        $query = $this->db->get_where('user', array('username' => $username));
        return $query->row_array();
    }

    public function verify_user($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        $user = $query->row();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
}
