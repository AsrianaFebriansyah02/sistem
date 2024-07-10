<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function createUser($data) {
        $this->db->insert('users', $data);
    }

    public function getUserByActivationCode($activation_code) {
        $query = $this->db->get_where('users', array('activation_code' => $activation_code));
        return $query->row_array();
    }

    public function updateUser($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

	

}
