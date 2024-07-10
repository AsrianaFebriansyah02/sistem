<?php

class JenjangPendidikanModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_jenjang_pendidikan($data)
    {
        $this->db->insert('jenjang_pendidikan', $data);
    }

    public function get_all_jenjang_pendidikan()
    {
        return $this->db->get('jenjang_pendidikan')->result();
    }

    public function update_jenjang_pendidikan($jenjang_pendidikan_id, $data)
    {
        $this->db->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
        $this->db->update('jenjang_pendidikan', $data);
    }

    public function delete_jenjang_pendidikan($jenjang_pendidikan_id)
    {
        $this->db->delete('jenjang_pendidikan', array('jenjang_pendidikan_id' => $jenjang_pendidikan_id));
    }

    public function get_jenjang_pendidikan_by_id($jenjang_pendidikan_id)
    {
        $this->db->select('*');
        $this->db->from('jenjang_pendidikan');
        $this->db->where('jenjang_pendidikan_id', $jenjang_pendidikan_id);
        $query = $this->db->get();
        return $query->row();
    }
}
