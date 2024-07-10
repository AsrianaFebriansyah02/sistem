-- tahun ajaran 
CREATE TABLE tahun_ajaran (
    tahun_ajaran_id VARCHAR(36) NOT NULL,
    nama_tahun VARCHAR(100) NOT NULL,
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('aktif', 'non-aktif') DEFAULT 'non-aktif',
    PRIMARY KEY (tahun_ajaran_id)
);
-- jenjang pendidikan 
CREATE TABLE jenjang_pendidikan (
    jenjang_pendidikan_id VARCHAR(36) NOT NULL,
    nama_jenjang_pendidikan VARCHAR(100) NOT NULL,
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (jenjang_pendidikan_id)
);
-- guru 
CREATE TABLE guru (
    guru_id VARCHAR(36) NOT NULL,
    nama_guru VARCHAR(100) NOT NULL,
    niy_guru VARCHAR(100) NOT NULL,
    jenis_kelamin VARCHAR(100) NOT NULL,
    tanggal_lahir VARCHAR(100) NOT NULL,
    alamat VARCHAR(100) NOT NULL,
    jabatan VARCHAR(100) NOT NULL,
    jenjang_pendidikan_id VARCHAR(36), -- Added the foreign key column
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (guru_id),
    FOREIGN KEY (jenjang_pendidikan_id) REFERENCES jenjang_pendidikan (jenjang_pendidikan_id)
);
-- transaksi 
CREATE TABLE transaksi (
    transaksi_id VARCHAR(36) NOT NULL,
    tanggal DATE NOT NULL,
    uraian VARCHAR(100) NOT NULL,  
    jenis_transaksi ENUM('debit', 'kredit') NOT NULL,
    user ENUM('admin', 'bendahara', 'kepsek', 'yayasan') NOT NULL,
    nominal DECIMAL(10, 2) NOT NULL,
    saldo DECIMAL(10, 2) NOT NULL,
    tahun_ajaran_id VARCHAR(36) NOT NULL, 
    user_id VARCHAR(36) NOT NULL, 
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (transaksi_id),
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran (tahun_ajaran_id),
    FOREIGN KEY (user_id) REFERENCES user (user_id)
);

-- tabel user
CREATE TABLE user(
  user_id varchar(36) NOT NULL,
  guru_id varchar(36) NOT NULL,
  username varchar(36) NOT NULL,
  password varchar(255) NOT NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  role ENUM('admin', 'bendahara','kepsek','yayasan') DEFAULT 'kepsek',
  PRIMARY KEY (user_id),
  FOREIGN KEY (guru_id) REFERENCES guru (guru_id) ON DELETE CASCADE
);
-- tabel backup
CREATE TABLE backup (
  backup_id varchar(36) NOT NULL,
  tanggal DATE NOT NULL,
  uraian varchar(36) NOT NULL,
  backup_data varchar(36) NOT NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id),
);