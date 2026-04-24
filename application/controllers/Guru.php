<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('role') != 'admin') redirect('dashboard');
    }

    public function index() {
        $data['judul'] = 'Manajemen Data Guru';
        $data['semua_guru'] = $this->db->get('users')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('guru/indeks', $data);
        $this->load->view('templates/footer', $data);
    }

    public function simpan() {
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'role' => $this->input->post('role')
        ];

        // Jika password diisi, maka update password
        $password = $this->input->post('password');
        if(!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if($id) {
            $this->db->where('id', $id);
            $this->db->update('users', $data);
            $this->session->set_flashdata('sukses', 'Data guru berhasil diperbarui.');
        } else {
            $this->db->insert('users', $data);
            $this->session->set_flashdata('sukses', 'Guru baru berhasil ditambahkan.');
        }

        redirect('guru');
    }

    public function hapus($id) {
        // Jangan biarkan admin menghapus dirinya sendiri jika hanya ada 1
        if($id == $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak bisa menghapus akun Anda sendiri yang sedang aktif.');
        } else {
            $this->db->where('id', $id);
            $this->db->delete('users');
            $this->session->set_flashdata('sukses', 'Data guru berhasil dihapus.');
        }
        redirect('guru');
    }

    public function reset_password($id) {
        $default_pass = password_hash('123456', PASSWORD_DEFAULT);
        
        $this->db->where('id', $id);
        $this->db->update('users', ['password' => $default_pass]);
        
        $this->session->set_flashdata('sukses', 'Password user berhasil direset menjadi: 123456');
        redirect('guru');
    }
}
