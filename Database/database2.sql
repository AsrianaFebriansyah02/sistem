-- tabele data pesantren

CREATE TABLE pesantren (
    pesantren_id VARCHAR(32) PRIMARY KEY, 
    nama_lembaga VARCHAR(255),
    nsm VARCHAR(20),
    npsm VARCHAR(20),
    alamat TEXT,
    kecamatan VARCHAR(50),
    kabupaten VARCHAR(50),
    provinsi VARCHAR(50),
    logo VARCHAR(255),
    guru_id VARCHAR(36),
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (guru_id) REFERENCES guru(guru_id) ON DELETE SET NULL
);

INSERT INTO pesantren (pesantren_id, nama_lembaga, nsm, npsm, alamat, kecamatan, kabupaten, provinsi, pimpinan, nip, logo)
VALUES 
(MD5('1'), 'Pesantren Apins Digital', '1234567890', '0987654321', 'Jl. Raya Pesantren No. 123', 'Kota', 'Kabupaten A', 'Provinsi X', 'logo.png');



-- tabel santri
CREATE TABLE santri (
  santri_id VARCHAR(36) PRIMARY KEY,
  no_induk VARCHAR(10),
  nik VARCHAR(20),
  no_kk VARCHAR(20),
  nama_santri VARCHAR(100),
  tempat_lahir VARCHAR(30),
  tanggal_lahir DATE,
  jenis_kelamin VARCHAR(10),
  alamat_santri TEXT,
  email VARCHAR(100),
  telp_santri VARCHAR(20),
  nama_ayah VARCHAR(100),
  alamat_ayah TEXT,
  pendidikan_ayah VARCHAR(20),
  pekerjaan_ayah VARCHAR(20),
  telp_ayah VARCHAR(20),
  nama_ibu VARCHAR(100),
  alamat_ibu TEXT,
  pendidikan_ibu VARCHAR(20),
  pekerjaan_ibu VARCHAR(20),
  telp_ibu VARCHAR(20),
  photo VARCHAR(255),
  status ENUM('aktif',  'lulus', 'non-aktif'),
	tahun_ajaran_id VARCHAR(100)  NULL,
	tanggal_masuk VARCHAR(100)  NULL,
	tanggal_keluar VARCHAR(100)  NULL,
	alasan_keluar VARCHAR(100)  NULL,
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran (tahun_ajaran_id)
);

INSERT INTO santri (santri_id, no_induk, nik, no_kk, nama_santri, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat_santri, email, telp_santri, nama_ayah, alamat_ayah, pendidikan_ayah, pekerjaan_ayah, telp_ayah, nama_ibu, alamat_ibu, pendidikan_ibu, pekerjaan_ibu, telp_ibu, photo, status)
VALUES 
(MD5('1'), '1234567890', '1234567890123456', '1234567890123456', 'Aqid', 'Jakarta', '2000-01-01', 'Laki-laki', 'Jl. Raya No. 123', 'ali@example.com', '081234567890', 'Abdul', 'Jl. Baru No. 456', 'SMA', 'PNS', '081234567891', 'Fatimah', 'Jl. Lama No. 789', 'SMA', 'Ibu Rumah Tangga', '081234567892', 'photo.jpg', 'non-aktif');

-- tabel guru
CREATE TABLE guru (
  guru_id VARCHAR(36) PRIMARY KEY,
  niy VARCHAR(20),
  nik VARCHAR(20),
  nama_guru VARCHAR(100),
  tempat_lahir VARCHAR(30),
  tanggal_lahir DATE,
  jenis_kelamin VARCHAR(10),
  alamat_guru TEXT,
  telp_guru VARCHAR(20),
  pendidikan VARCHAR(20),
  qrcode VARCHAR(255),
  photo VARCHAR(255),
  status ENUM('aktif', 'non-aktif'),
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO guru (guru_id, niy, nik, nama_guru, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat_guru, telp_guru, pendidikan, photo, status)
VALUES 
(MD5('1'), '1234567890', '1234567890123456', 'apins', 'Jakarta', '1980-01-01', 'Laki-laki', 'Jl. Raya No. 123', '081234567890', 'Sarjana (S1)', 'apins.jpg', 'aktif');



-- tahun ajaran 
CREATE TABLE tahun_ajaran (
    tahun_ajaran_id VARCHAR(36) NOT NULL,
    kode_tahun VARCHAR(20) NOT NULL,
    nama_tahun VARCHAR(100) NOT NULL,
		create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('aktif', 'non-aktif') DEFAULT 'non-aktif',
    PRIMARY KEY (tahun_ajaran_id),
    UNIQUE INDEX idx_tahun_ajaran_kode_tahun (kode_tahun)
);

-- kelas
CREATE TABLE kelas (
    kelas_id VARCHAR(36) NOT NULL,
    guru_id VARCHAR(50),
    tahun_ajaran_id VARCHAR(50) NOT NULL,
    kode_kelas VARCHAR(255),
    kelas VARCHAR(255),
    jenis_kelas VARCHAR(255),
    target_kelas VARCHAR(255),
    PRIMARY KEY (kelas_id),
    FOREIGN KEY (guru_id) REFERENCES guru(guru_id) ON DELETE SET NULL,
    FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran (tahun_ajaran_id) ON DELETE CASCADE,
    create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- target atau kkm
CREATE TABLE kkm (
  kkm_id varchar(36) NOT NULL,
  kkm int(3) NULL,
  kelas_id varchar(36) NOT NULL,
  tahun_ajaran_id varchar(36) NOT NULL,
  semester varchar(36) NOT NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (kkm_id),
  FOREIGN KEY (kelas_id) REFERENCES kelas (kelas_id),
  FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran (tahun_ajaran_id)  ON DELETE CASCADE
);


-- mata pelajaran
CREATE TABLE mapel (
  mapel_id varchar(36) NOT NULL,
  kode_mapel varchar(50) NOT NULL,
  nama_mapel varchar(50) NOT NULL,
	create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (mapel_id)
);

-- data ajar
CREATE TABLE data_ajar (
  data_ajar_id varchar(36) NOT NULL,
  kelas_id varchar(36) NOT NULL,
  guru_id varchar(36) NOT NULL,
  mapel_id varchar(36) NOT NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (data_ajar_id),
  FOREIGN KEY (kelas_id) REFERENCES kelas (kelas_id) ON DELETE CASCADE,
  FOREIGN KEY (mapel_id) REFERENCES mapel (mapel_id) ON DELETE CASCADE,
  FOREIGN KEY (guru_id) REFERENCES guru (guru_id) ON DELETE CASCADE
);

-- data semester
CREATE TABLE semester (
  semester_id varchar(36) NOT NULL,
  semester varchar(36) NOT NULL,
  tahun_ajaran_id varchar(36) NOT NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (semester_id),
  FOREIGN KEY (tahun_ajaran_id) REFERENCES tahun_ajaran (tahun_ajaran_id) ON DELETE CASCADE
);

-- tabel user
CREATE TABLE users (
  user_id varchar(36) NOT NULL,
  username varchar(36) NOT NULL,
  password varchar(255) NOT NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	role ENUM('admin', 'guru','wali','pembimbing') DEFAULT 'guru',
  PRIMARY KEY (user_id),
	FOREIGN KEY (user_id) REFERENCES guru (guru_id) ON DELETE CASCADE
);

-- tabel users profile
CREATE TABLE users_profile (
  users_profile_id varchar(36) NOT NULL,
  user_id varchar(36) NULL,
  guru_id varchar(36) NULL,
  santri_id varchar(36) NULL,
  create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (users_profile_id),
  FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
  FOREIGN KEY (guru_id) REFERENCES guru (guru_id) ON DELETE CASCADE,
  FOREIGN KEY (santri_id) REFERENCES santri (santri_id) ON DELETE CASCADE
);

-- guru profil
CREATE TABLE guru_profile (
  guru_profile_id VARCHAR(36) PRIMARY KEY,
  user_id VARCHAR(36) NOT NULL,
  guru_id varchar(36)  NULL,
  FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
	FOREIGN KEY (guru_id) REFERENCES guru (guru_id) ON DELETE CASCADE
);

-- santri profile
CREATE TABLE santri_profile (
  santri_profile_id VARCHAR(36) PRIMARY KEY,
  user_id VARCHAR(36) NOT NULL,
  santri_id varchar(36) NULL,
  FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE,
	FOREIGN KEY (santri_id) REFERENCES santri (santri_id) ON DELETE CASCADE
);

-- tabel prestasi
CREATE TABLE prestasi (
    prestasi_id VARCHAR(36) NOT NULL,
    santri_id VARCHAR(36) NOT NULL,
    jenis_prestasi VARCHAR(20) NULL,
    tingkat_prestasi VARCHAR(20) NULL,
    nama_prestasi VARCHAR(100) NULL,
    tahun_prestasi VARCHAR(10) NULL,
    penyelenggara VARCHAR(100) NULL,
    peringkat VARCHAR(100) NULL,
    PRIMARY KEY (prestasi_id),
		FOREIGN KEY (santri_id) REFERENCES santri (santri_id) ON DELETE CASCADE
);

-- tabel beasiswa
CREATE TABLE beasiswa (
    beasiswa_id VARCHAR(36) NOT NULL,
    santri_id VARCHAR(36) NOT NULL,
    jenis_beasiswa VARCHAR(20) NULL,
    perguruan_tinggi VARCHAR(255) NULL,
    negara_tujuan VARCHAR(255) NULL,
    skala ENUM('Dalam Negri', 'Luar Negri'),
    tahun_mulai VARCHAR(10) NULL,
    tahun_selesai VARCHAR(10) NULL,
    PRIMARY KEY (beasiswa_id),
		FOREIGN KEY (santri_id) REFERENCES santri (santri_id) ON DELETE CASCADE
);

-- kelas santri
CREATE TABLE kelas_santri (
    kelas_santri_id VARCHAR(36) NOT NULL,
    kelas_id VARCHAR(255),
    santri_id INT,
    PRIMARY KEY (kelas_santri_id),
    FOREIGN KEY (kelas_id) REFERENCES kelas (kelas_id) ON DELETE CASCADE,
    FOREIGN KEY (santri_id) REFERENCES santri (santri_id) ON DELETE CASCADE
);



