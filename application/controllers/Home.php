<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
        $this->load->model('UsersModel');
        $this->load->model('LembagaModel');
        $this->load->model('ProdiModel');
        $this->load->model('PendidikanModel');
        $this->load->model('DosenModel');
        $this->load->library('email');
        $this->load->model('MahasiswaModel');
        $this->load->model('TahunAjaranModel');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('FaqsModel');
        $this->data['faqs'] = $this->FaqsModel->get_all_faqs();
        $this->data['lembaga'] = $this->LembagaModel->get_lembaga();
    }

    public function index()
    {
        $this->data['title'] = 'Home Page';
        $this->load->view('auth/home', $this->data);
    }

    public function lupapw()
    {
        $this->data['title'] = 'Halaman Lupa Password';
        $this->load->view('auth/lupa-pw', $this->data);
    }


    public function login()
    {
        $this->data['title'] = 'Halaman Login';

        $this->load->view('auth/login', $this->data);
    }

    public function register()
    {
        $this->data['title'] = 'Halaman Register';

        $this->data['prodi'] = $this->ProdiModel->get_data_prodi();
        $this->data['pendidikan'] = $this->PendidikanModel->get_all_pendidikan();

        $this->data['tahunajaran'] = $this->TahunAjaranModel->get_all_tahun_ajaran();
        $this->load->view('auth/register', $this->data);
    }

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('AuthModel');
        $user = $this->AuthModel->login($username, $password);
        if ($user) {
            // Set user_id dan role di sesi
            $this->session->set_userdata('user_id', $user->user_id);
            $this->session->set_userdata('role', $user->role);
            $this->session->set_userdata('status', 'telah_login');

            $this->session->set_flashdata('alert', '<div class="alert  alert-info">Data berhasil di tambahkan !</div>');
            $this->session->set_flashdata('alert_timeout', 4000);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('alert', '<div class="alert  alert-danger">Username atau password salah !</div>');
            $this->session->set_flashdata('alert_timeout', 4000);
            redirect('login');
        }
    }


    public function reg_dosen()
    {
        $nidn = $this->input->post('nidn');

        $nidn_exists = $this->DosenModel->cek_nidn_exist($nidn);
        if ($nidn_exists) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">nidn sudah terdaftar dalam database!</div>');
            $this->session->set_flashdata('alert_timeout', 4000);
            redirect('register');
            return;
        }

        $this->form_validation->set_rules('email', '"Email"', 'required|trim|is_unique[dosen.email]');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">email sudah terdaftar dalam database!</div>');
            $this->session->set_flashdata('alert_timeout', 4000);
            redirect('register');
        } else {
            $data = array(
                'dosen_id' => md5(date('YmdHis') . rand(1000, 9999)),
                'no_card' => rand(1000, 9999),
                'nidn' => $nidn,
                'prodi_id' => $this->input->post('prodi_id'),
                'nama_dosen' => $this->input->post('nama_dosen'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat_dosen' => $this->input->post('alamat_dosen'),
                'telp_dosen'  => $this->input->post('telp_dosen'),
                'pendidikan_id'  => $this->input->post('pendidikan'),
                'email'  => $this->input->post('email'),
                'photo'  => 'user.jpg',
                'status' => 'non-aktif',
            );

            $this->DosenModel->insert_dosen($data);

            // Kirim email aktivasi
            $emailData = array(
                'email' => $data['email'],
                'nama_dosen' => $data['nama_dosen'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'nidn' => $data['nidn'],
                'tempat_lahir' => $data['tempat_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'telp_dosen' => $data['telp_dosen'],
                'dosen_id' => $data['dosen_id']
            );
            // Kirim email aktivasi
            $this->sendActivationEmail($emailData);
            // Tampilkan pesan sukses
            $this->session->set_flashdata('alert', '<div class="alert  alert-info">Registrasi berhasil. Silahkan cek email Anda untuk mengaktifkan akun Anda.!</div>');
            $this->session->set_flashdata('alert_timeout', 10000);
            redirect('login');
        }
    }

    private function sendActivationEmail($emailData)
    {

        $email = $emailData['email'];
        $dosen_id = $emailData['dosen_id'];
        // Konfigurasi email
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => 'apinsdigital@gmail.com',
            'smtp_pass' => 'Subhanallah123',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );

        $this->load->library('email', $config);

        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('apinsdigital@gmail.com', 'LPPM Universitas Annuqayah');
        $this->email->to($email);
        $this->email->subject('Account Activation');

        $message = $this->load->view('auth/email_activation', $emailData, true);
        $this->email->message($message);
        $this->email->send();
        // if ($this->email->send()) {
        //     echo "Email berhasil dikirim.";
        // } else {
        //     echo "Email gagal dikirim.";
        //     echo $this->email->print_debugger(); 
        // }
    }

    public function activate($dosen_id)
    {
        // Cari data dosen berdasarkan dosen_id
        $dosen_activation = $this->DosenModel->getDosenByActivationCode($dosen_id);

        if ($dosen_activation) {
            // Aktifkan akun
            $data = array('status' => 'aktif');
            $this->DosenModel->update_status($dosen_id, $data);

            // Set username menggunakan NIDN
            $username = $dosen_activation['nidn'];
            $role = 'dosen';
            $tanggal_lahir = date('Ymd', strtotime($dosen_activation['tanggal_lahir']));
            $password = password_hash($tanggal_lahir, PASSWORD_DEFAULT);

            // Cek apakah username sudah ada di tabel users
            $username_exists = $this->UsersModel->checkUsernameExists($username);
            if ($username_exists) {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" style="text-align: justify;">Aktifasi akun gagal, akun sudah terdaftar, silahkan register ulang dengan akun lain!</div>');
                $this->session->set_flashdata('alert_timeout', 10000);
                redirect('login');
            } else {
                // Simpan data ke tabel users
                $data_users = array(
                    'user_id' => $dosen_id,
                    'username' => $username,
                    'password' => $password,
                    'role' => $role
                );
                $this->AuthModel->register($data_users);
                // Simpan data ke tabel users_profile
                $data_profile = array(
                    'users_profile_id' => md5(date('YmdHis') . rand(1000, 9999)),
                    'user_id' => $dosen_id,
                    'dosen_id' => $dosen_id,
                );
                $this->AuthModel->insert_user_profile($data_profile);

                // Tampilkan halaman aktivasi berhasil
                $this->session->set_flashdata('alert', '<div class="alert alert-info">Aktifasi akun berhasil, silahkan login!</div>');
                $this->session->set_flashdata('alert_timeout', 8000);
                redirect('login');
            }
        } else {
            // Tampilkan halaman aktivasi gagal karena data tidak ditemukan
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Aktifasi akun gagal, data tidak ditemukan!</div>');
            $this->session->set_flashdata('alert_timeout', 8000);
            $this->load->view('login');
        }
    }
    // and reg dosen


    // reg mahasiswa

    public function reg_mahasiswa()
    {
        $nim = $this->input->post('nim');

        $nim_exists = $this->MahasiswaModel->cek_nim_exist($nim);
        if ($nim_exists) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">nim sudah terdaftar dalam database!</div>');
            $this->session->set_flashdata('alert_timeout', 4000);
            redirect('register');
            return;
        }

        $this->form_validation->set_rules('email', '"Email"', 'required|trim|is_unique[mahasiswa.email]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">email sudah terdaftar dalam database!</div>');
            $this->session->set_flashdata('alert_timeout', 4000);
            redirect('register');
        } else {

            $data = array(
                'mahasiswa_id' => md5(date('YmdHis') . rand(1000, 9999)),
                'no_card' => rand(1000, 9999),
                'nim' => $nim,
                'prodi_id' => $this->input->post('prodi_id'),
                'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat_mahasiswa' => $this->input->post('alamat_mahasiswa'),
                'telp_mahasiswa'  => $this->input->post('telp_mahasiswa'),
                'email'  => $this->input->post('email'),
                'photo'  => 'user.jpg',
                'tahun_ajaran_id'  => $this->input->post('tahun_ajaran_id'),
                'tanggal_masuk'  => date('Y-m-d H:i:s'),
                'status'  => 'non-aktif',
            );

            $this->MahasiswaModel->insert_mahasiswa($data);

            // Kirim email aktivasi
            $EmailDataMahasiswa = array(
                'email' => $data['email'],
                'nama_mahasiswa' => $data['nama_mahasiswa'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'nim' => $data['nim'],
                'tempat_lahir' => $data['tempat_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'telp_mahasiswa' => $data['telp_mahasiswa'],
                'tanggal_masuk' => $data['tanggal_masuk'],
                'mahasiswa_id' => $data['mahasiswa_id']
            );
            // Kirim email aktivasi
            $this->sendActivationEmailMahasiswa($EmailDataMahasiswa);
            // Tampilkan pesan sukses
            $this->session->set_flashdata('alert', '<div class="alert  alert-info">Registrasi berhasil. Silahkan cek email Anda untuk mengaktifkan akun Anda.!</div>');
            $this->session->set_flashdata('alert_timeout', 8000);
            redirect('login');
        }
    }

    private function sendActivationEmailMahasiswa($EmailDataMahasiswa)
    {
        $email = $EmailDataMahasiswa['email'];
        $mahasiswa_id = $EmailDataMahasiswa['mahasiswa_id'];
        // Konfigurasi email
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 587,
            'smtp_user' => 'apinsdigital@gmail.com',
            'smtp_pass' => 'Subhanallah123',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );

        $this->load->library('email', $config);

        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from('apinsdigital@gmail.com', 'LPPM Universitas Annuqayah');
        $this->email->to($email);
        $this->email->subject('Account Activation');

        $message = $this->load->view('auth/email_activation_mahasiswa', $EmailDataMahasiswa, true);
        $this->email->message($message);
        $this->email->send();
    }

    public function activate_mahasiswa($mahasiswa_id)
    {
        // Cari data mahasiswa berdasarkan mahasiswa_id
        $mahasiswa_activation = $this->MahasiswaModel->getmahasiswaByActivationCode($mahasiswa_id);

        if ($mahasiswa_activation) {
            // Aktifkan akun
            $data = array('status' => 'aktif');
            $this->MahasiswaModel->update_status($mahasiswa_id, $data);

            // Set username menggunakan nim
            $username = $mahasiswa_activation['nim'];
            $role = 'mahasiswa';
            $tanggal_lahir = date('Ymd', strtotime($mahasiswa_activation['tanggal_lahir']));
            $password = password_hash($tanggal_lahir, PASSWORD_DEFAULT);

            // Cek apakah username sudah ada di tabel users
            $username_exists = $this->UsersModel->checkUsernameExists($username);
            if ($username_exists) {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger" style="text-align: justify;">Aktifasi akun gagal, akun sudah terdaftar, silahkan register ulang dengan akun lain!</div>');
                $this->session->set_flashdata('alert_timeout', 10000);
                redirect('login');
            } else {
                // Simpan data ke tabel users
                $data_users = array(
                    'user_id' => $mahasiswa_id,
                    'username' => $username,
                    'password' => $password,
                    'role' => $role
                );
                $this->AuthModel->register($data_users);
                // Simpan data ke tabel users_profile
                $data_profile = array(
                    'users_profile_id' => md5(date('YmdHis') . rand(1000, 9999)),
                    'user_id' => $mahasiswa_id,
                    'mahasiswa_id' => $mahasiswa_id,
                );
                $this->AuthModel->insert_user_profile($data_profile);

                // Tampilkan halaman aktivasi berhasil
                $this->session->set_flashdata('alert', '<div class="alert alert-info">Aktifasi akun berhasil, silahkan login!</div>');
                $this->session->set_flashdata('alert_timeout', 8000);
                redirect('login');
            }
        } else {
            // Tampilkan halaman aktivasi gagal karena data tidak ditemukan
            $this->session->set_flashdata('alert', '<div class="alert alert-danger">Aktifasi akun gagal, data tidak ditemukan!</div>');
            $this->session->set_flashdata('alert_timeout', 8000);
            $this->load->view('login');
        }
    }

    public function logout()
    {

        $this->session->set_flashdata('alert', '<div class="alert  alert-info">Anda berhasil logout !</div>');
        $this->session->set_flashdata('alert_timeout', 4000);
        $this->session->sess_destroy();
        redirect('login?alert=logout');
    }
}
