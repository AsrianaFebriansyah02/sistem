<?php
class Backup_history_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create($filename, $filepath)
    {
        $data = array(
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

    
    public function restoreData($file_path) {
        // Mendapatkan informasi database dari konfigurasi
        $db_host = $this->db->hostname;
        $db_user = $this->db->username;
        $db_pass = $this->db->password;
        $db_name = $this->db->database;
        
        // Mendapatkan perintah untuk mengembalikan data
        $command = "mysql -h $db_host -u $db_user -p$db_pass $db_name < $file_path";
        
        // Menjalankan perintah restore menggunakan shell_exec()
        $output = shell_exec($command);
        
        // Mengembalikan status restore (berhasil atau gagal)
        return !empty($output);
    }

}

