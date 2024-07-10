<?php
class TransaksiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_transaksi($data)
    {
        $this->db->insert('transaksi', $data);
    }

    public function get_all_transaksi()
    {
        $this->db->select('transaksi.*, tahun_ajaran.*, user.*, 
        (CASE WHEN transaksi.jenis_transaksi = "debit" THEN transaksi.nominal ELSE 0 END) AS debit, 
        (CASE WHEN transaksi.jenis_transaksi = "kredit" THEN transaksi.nominal ELSE 0 END) AS kredit');
        $this->db->from('transaksi');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = transaksi.tahun_ajaran_id');
        $this->db->join('user', 'user.user_id = transaksi.user_id');
        return $this->db->get()->result();
    }

    public function update_transaksi($transaksi_id, $data)
    {
        $this->db->where('transaksi_id', $transaksi_id);
        $this->db->update('transaksi', $data);
    }

    public function delete_transaksi($transaksi_id)
    {
        $this->db->delete('transaksi', array('transaksi_id' => $transaksi_id));
    }

    public function get_transaksi_by_id($transaksi_id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('transaksi_id', $transaksi_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_all_jenjang_pendidikan()
    {
        return $this->db->get('jenjang_pendidikan')->result_array();
    }

    public function get_all_tahun_ajaran()
    {
        return $this->db->get('tahun_ajaran')->result_array();
    }

    public function get_user()
    {
        return $this->db->get('user')->result_array();
    }

    public function get_saldo()
    {
        $this->db->select('
        SUM(CASE WHEN jenis_transaksi = "debit" THEN nominal ELSE 0 END) AS total_debit, 
        SUM(CASE WHEN jenis_transaksi = "kredit" THEN nominal ELSE 0 END) AS total_kredit, 
        (SUM(CASE WHEN jenis_transaksi = "debit" THEN nominal ELSE 0 END) - SUM(CASE WHEN jenis_transaksi = "kredit" THEN nominal ELSE 0 END)) AS saldo');
        $this->db->from('transaksi');
        return $this->db->get()->row();
    }

    public function get_data_transaksi()
    {
        $this->db->select('
        transaksi.*,
        user.*,
        (CASE WHEN transaksi.jenis_transaksi = "debit" THEN transaksi.nominal ELSE 0 END) AS debit,
        (CASE WHEN transaksi.jenis_transaksi = "kredit" THEN transaksi.nominal ELSE 0 END) AS kredit
        ');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.tahun_ajaran_id = transaksi.tahun_ajaran_id');
        $this->db->join('user', 'user.user_id = transaksi.user_id');
        return $this->db->get()->result();
    }
}
