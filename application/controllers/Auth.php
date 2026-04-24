<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        // --- HELPER OTOMATIS: Update Role & Buat User Walikelas ---
        // (Bisa dihapus setelah dijalankan sekali)
        $this->db->query("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'guru_bk', 'walikelas') NOT NULL");
        $cek_wali = $this->db->get_where('users', ['username' => 'walikelas'])->row();
        if (!$cek_wali) {
            $this->db->insert('users', [
                'username' => 'walikelas',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Wali Kelas XI IPA 1',
                'role' => 'walikelas'
            ]);
        }
        // --- END HELPER ---

        if ($this->session->userdata('logged_in')) redirect('dashboard');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('users', ['username' => $username])->row();

            if ($user) {
                // Verifikasi password yang sudah terenkripsi (Hashed Password)
                if (password_verify($password, $user->password)) {
                    $session_data = [
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'nama_lengkap' => $user->nama_lengkap,
                        'role' => $user->role,
                        'logged_in' => TRUE
                    ];
                    $this->session->set_userdata($session_data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Kata sandi salah!');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('error', 'Username tidak ditemukan!');
                redirect('auth');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
