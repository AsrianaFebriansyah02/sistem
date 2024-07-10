<?php

class GuruModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Fungsi untuk menyimpan data guru
    public function insert_guru($data)
    {
        $this->db->insert('guru', $data);
    }

    // Fungsi untuk mendapatkan semua data guru
    public function get_all_guru()
    {
        // Mengambil data guru beserta nama jenjang pendidikan
        $this->db->select('guru.*, jenjang_pendidikan.nama_jenjang_pendidikan');
        $this->db->from('guru');
        $this->db->join('jenjang_pendidikan', 'jenjang_pendidikan.jenjang_pendidikan_id = guru.jenjang_pendidikan_id');
        return $this->db->get()->result();
    }

    // Fungsi untuk mengupdate data guru
    public function update_guru($guru_id, $data)
    {
        $this->db->where('guru_id', $guru_id);
        $this->db->update('guru', $data);
    }

    // Fungsi untuk menghapus data guru
    public function delete_guru($guru_id)
    {
        $this->db->delete('guru', array('guru_id' => $guru_id));
    }

    // Fungsi untuk mendapatkan data guru berdasarkan ID
    public function get_guru_by_id($guru_id)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->where('guru_id', $guru_id);
        $query = $this->db->get();
        return $query->row();
    }

    // Fungsi untuk mendapatkan data jenjang pendidikan
    public function get_jenjang_pendidikan()
    {
        return $this->db->get('jenjang_pendidikan')->result();
    }
}
