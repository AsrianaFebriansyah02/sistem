<?php
class SettingModel extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_setting()
    {
        $query = $this->db->get('setting');
        return $query->result_array();
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    public function insert_file($file_data) {
        // Simpan data file ke tabel 'setting'
        $this->db->insert('setting', $file_data);
    }

    public function get_file($id) {
        // Ambil data file dari tabel 'setting' berdasarkan ID
        $query = $this->db->get_where('setting', array('id' => $id));
        return $query->row_array();
    }

    public function update_file($id, $update_data) {
        // Update data file di tabel 'setting' berdasarkan ID
        $this->db->where('id', $id);
        $this->db->update('setting', $update_data);
    }

    public function delete_file($id) {
        // Hapus data file dari tabel 'setting' berdasarkan ID
        $this->db->where('id', $id);
        $this->db->delete('setting');
    }

}
