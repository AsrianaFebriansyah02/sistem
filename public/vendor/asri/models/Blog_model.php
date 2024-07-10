<?php

    class Blog_model extends CI_Model {
        public function search($keyword) {
          $this->db->like('judul', $keyword); // Lakukan pencarian pada kolom "judul"
          $this->db->or_like('isi', $keyword); // Lakukan pencarian pada kolom "isi"
          return $this->db->get('blog')->result(); // Ambil hasil pencarian dari tabel "blog"
        }
      }
      
