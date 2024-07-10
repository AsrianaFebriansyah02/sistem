<?php

class TahunAjaranModel extends CI_Model {

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert_tahun_ajaran($data) {
        $this->db->insert('tahun_ajaran', $data);
    }

    public function get_all_tahun_ajaran() {
        return $this->db->get('tahun_ajaran')->result();
    }

    public function update_tahun_ajaran($tahun_ajaran_id, $data) {
        $this->db->where('tahun_ajaran_id', $tahun_ajaran_id);
        $this->db->update('tahun_ajaran', $data);
    }

    public function delete_tahun_ajaran($tahun_ajaran_id) {
        $this->db->delete('tahun_ajaran', array('tahun_ajaran_id' => $tahun_ajaran_id));
    }

	public function get_tahun_ajaran_by_id($tahun_ajaran_id) {
        $this->db->select('*');
        $this->db->from('tahun_ajaran');
        $this->db->where('tahun_ajaran_id', $tahun_ajaran_id);
        $query = $this->db->get();
        return $query->row();
    }
}
