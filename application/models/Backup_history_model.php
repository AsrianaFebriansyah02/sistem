<?php
class Backup_history_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create($filename, $filepath, $backup_id)
    {
        $data = array(
            'backup_id' => $backup_id,
            'filename' => $filename,
            'filepath' => $filepath,
            'created_at' => date('Y-m-d H:i:s')
        );

        return $this->db->insert('backup_history', $data);
    }

    public function get_all()
    {
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get('backup_history');
        return $query->result_array();
    }

    public function delete_backup_history($backup_id)
    {
        $this->db->delete('backup_history', array('backup_id' => $backup_id));
    }
}
