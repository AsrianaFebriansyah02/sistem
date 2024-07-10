<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('AuthModel');
		$this->load->model('SettingModel');
        $this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('url');

    }

	public function login()
    {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, tampilkan kembali halaman login dengan pesan kesalahan
			$this->session->set_flashdata('gagal', '<div class="alert alert-danger font-weight-bold" align="justify"> Registration failed, please re-register! </div>');
			redirect('login');
		} else {
			// Jika validasi sukses, periksa email dan password
			$email = $this->input->post('email');
			$password = $this->input->post('password');
	
			$this->load->model('AuthModel');
			$user = $this->AuthModel->get_user_by_email($email);
	
			if ($user && password_verify($password, $user['password'])) {
				if ($user['is_active'] == 1) {
					$data_session = array(
						'id' => $user['id'],
						'name' => $user['name'],
						'email' => $user['email'],
						'level' => $user['level'],
						'status' => 'telah_login'
					);

					// Catat aktivitas login
					
					$this->load->model('LogModel');
					$this->logActivity($user['id'], 'logged in');

					// Mengirim email informasi sistem
					$this->sendSystemInfoEmail($user['email']);

					$this->session->set_userdata($data_session);
					
					// Login berhasil, set session dan redirect ke halaman utama
					$this->session->set_flashdata('success', 'You have successfully logged in!');
					redirect('backend/dashboard');
				} else {
					// Pengguna belum diverifikasi, tampilkan pesan kesalahan
					$this->session->set_flashdata('gagal', '<div class="alert alert-danger font-weight-bold" align="justify"> Account has not been verified. Please check your email. </div>');
					redirect('login');
				}
			} else {
				// Email atau password tidak cocok, tampilkan pesan kesalahan
				$this->session->set_flashdata('gagal', '<div class="alert alert-danger font-weight-bold" align="justify"> Login failed, Incorrect email or password.!  </div>');
				redirect('login');
			}
		}
	}

	private function logActivity($user_id, $activity)
	{
		$this->load->model('LogModel');
		$this->LogModel->logActivity($user_id, $activity);
	}


	private function getSystemInfo()
	{
		$system_info = array(
			'Operating System' => PHP_OS,
			'Server Software' => $_SERVER['SERVER_SOFTWARE'],
			'PHP Version' => PHP_VERSION,
			// Tambahkan informasi sistem lainnya sesuai kebutuhan
		);
	
		return $system_info;
	}

	private function sendSystemInfoEmail($email)
	{
		$system_info = $this->getSystemInfo();
		
		$this->load->library('email');
		
		// Konfigurasi email
		$this->email->from('apinsdigital@gmail.com', 'Apins Digital');
		$this->email->to($email);
		$this->email->subject('System Information');
		
		$message = 'System Information:' . PHP_EOL;
		foreach ($system_info as $key => $value) {
			$message .= $key . ': ' . $value . PHP_EOL;
		}
		$this->email->message($message);
		
		// Mengirim email
		$this->email->send();
	}
	

	public function register() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', '"Email"', 'required|trim|is_unique[users.email]', [
            'is_unique' => 'Email ini sudah terdaftar!!'
        ]);
        $this->form_validation->set_rules('password1', '"Password"', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password yang anda masukkan tidak sama!',
            'min_length' => 'Password minimal 8 karakter!'
        ]);
		$this->form_validation->set_rules('password2', 'password2', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('username', 'Username', 'required');


        if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('gagal', '<div class="alert alert-danger font-weight-bold" align="justify"> Registration failed, please re-register.!  </div>');
			redirect('register');
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'activation_code' => md5(random_bytes(32)),
				'level' => 'penulis',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
                'is_active' => 0
            );
            
            $this->Users_model->createUser($data);
            
            // Kirim email aktivasi
            $this->sendActivationEmail($data['email'], $data['activation_code']);
            
            // Tampilkan pesan sukses
			$this->session->set_flashdata('success', '<div class="alert alert-success font-weight-bold"  align="justify"> Registration successful. Please check your email to activate your account.! </div>');
		     redirect('login');
        }
    }
    

    private function sendActivationEmail($email, $activation_code) {
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

        $this->email->set_newline("\r\n");
        $this->email->from('apinsdigital@gmail.com', 'Apins Digial');
        $this->email->to($email);
        $this->email->subject('Account Activation');
        $this->email->message("Please click this link to activate your account: " . base_url('auth/activate/' . $activation_code));
        
        $this->email->send();
		if ($this->email->send()) {
			echo "Email berhasil dikirim.";
		} else {
			echo "Email gagal dikirim.";
			echo $this->email->print_debugger(); // Untuk menampilkan pesan error jika ada
		}
    }

    
    public function activate($activation_code) {
        $user = $this->Users_model->getUserByActivationCode($activation_code);
        
        if ($user) {
            $data = array(
                'is_active' => 1,
                'activation_code' => ''
            );
            
            $this->Users_model->updateUser($user['id'], $data);
            
            $this->session->set_flashdata('success', '<b>Account activated successfully, You can now login.</b>');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Invalid activation code.');
            redirect('register');
        }
    }

	public function logout() {
        // Destroy session data
        $this->session->sess_destroy();

        // Redirect to login page or any desired page
        redirect('login?alert=logout');
    }

}
