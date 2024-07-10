<?php

class UserModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk menyimpan data user
    public function insert_user($data)
    {
        $this->db->insert('user', $data);
    }

    // Fungsi untuk mendapatkan semua data user
    public function get_all_user()
    {
        // Mengambil data user beserta nama guru
        $this->db->select('user.*, guru.nama_guru,guru.niy_guru');
        $this->db->from('user');
        $this->db->join('guru', 'guru.guru_id = user.guru_id');
        return $this->db->get()->result();
    }

    // Fungsi untuk mengupdate data user
    public function update_user($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('user', $data);
    }

    // Fungsi untuk menghapus data user
    public function delete_user($user_id)
    {
        $this->db->delete('user', array('user_id' => $user_id));
    }

    // Fungsi untuk mendapatkan data user berdasarkan ID
    public function get_user_by_id($user_id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk mendapatkan data guru
    public function get_guru()
    {
        return $this->db->get('guru')->result();
    }
}
