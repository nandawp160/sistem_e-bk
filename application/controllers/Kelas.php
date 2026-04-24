<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('role') != 'admin') redirect('dashboard');
        $this->_check_table_kelas();
    }

    public function index() {
        $data['judul'] = 'Manajemen Data Kelas';
        
        // Ambil data kelas beserta nama wali kelasnya
        $this->db->select('kelas.*, users.nama_lengkap as wali_kelas');
        $this->db->from('kelas');
        $this->db->join('users', 'users.id = kelas.walikelas_id', 'left');
        $data['semua_kelas'] = $this->db->get()->result();

        // Ambil data user yang role-nya walikelas saja untuk dipilih jadi wali kelas
        $this->db->where('role', 'walikelas');
        $data['guru'] = $this->db->get('users')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kelas/indeks', $data);
        $this->load->view('templates/footer', $data);
    }

    public function simpan() {
        $data = [
            'nama_kelas' => $this->input->post('nama_kelas'),
            'walikelas_id' => $this->input->post('walikelas_id') ?: NULL
        ];
        
        $id = $this->input->post('id');
        if($id) {
            $this->db->where('id', $id);
            $this->db->update('kelas', $data);
        } else {
            $this->db->insert('kelas', $data);
        }
        
        $this->session->set_flashdata('sukses', 'Data kelas berhasil disimpan.');
        redirect('kelas');
    }

    public function hapus($id) {
        $this->db->where('id', $id);
        $this->db->delete('kelas');
        $this->session->set_flashdata('sukses', 'Data kelas berhasil dihapus.');
        redirect('kelas');
    }

    public function acak() {
        // 1. Ambil semua kelas yang belum punya wali kelas
        $kelas_kosong = $this->db->get_where('kelas', ['walikelas_id' => NULL])->result();
        
        if (empty($kelas_kosong)) {
            $this->session->set_flashdata('error', 'Semua kelas sudah memiliki wali kelas.');
            redirect('kelas');
        }

        // 2. Ambil semua ID guru yang sudah jadi wali kelas
        $this->db->select('walikelas_id');
        $this->db->where('walikelas_id !=', NULL);
        $guru_terpakai = $this->db->get('kelas')->result_array();
        $ids_terpakai = array_column($guru_terpakai, 'walikelas_id');

        // 3. Ambil guru yang tersedia (HANYA role walikelas dan belum terpakai)
        $this->db->where('role', 'walikelas');
        if (!empty($ids_terpakai)) {
            $this->db->where_not_in('id', $ids_terpakai);
        }
        $guru_tersedia = $this->db->get('users')->result();

        if (empty($guru_tersedia)) {
            $this->session->set_flashdata('error', 'Tidak ada guru tersedia yang belum menjabat sebagai wali kelas.');
            redirect('kelas');
        }

        // 4. Acak daftar guru
        shuffle($guru_tersedia);

        // 5. Pasangkan guru ke kelas
        $count = 0;
        foreach ($kelas_kosong as $k) {
            if (empty($guru_tersedia)) break; // Berhenti jika guru habis

            $guru = array_shift($guru_tersedia);
            $this->db->where('id', $k->id);
            $this->db->update('kelas', ['walikelas_id' => $guru->id]);
            $count++;
        }

        if ($count > 0) {
            $this->session->set_flashdata('sukses', "$count kelas berhasil dipasangkan dengan wali kelas secara acak.");
        } else {
            $this->session->set_flashdata('error', 'Gagal memasangkan wali kelas secara acak.');
        }

        redirect('kelas');
    }

    public function kosongkan() {
        $this->db->update('kelas', ['walikelas_id' => NULL]);
        $this->session->set_flashdata('sukses', 'Seluruh data Wali Kelas telah dikosongkan.');
        redirect('kelas');
    }

    private function _check_table_kelas() {
        if (!$this->db->table_exists('kelas')) {
            $this->db->query("CREATE TABLE kelas (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nama_kelas VARCHAR(50) NOT NULL,
                walikelas_id INT,
                FOREIGN KEY (walikelas_id) REFERENCES users(id) ON DELETE SET NULL
            )");
            
            // Masukkan data awal dari kelas yang ada di tabel siswa
            $exist_kelas = $this->db->select('kelas')->distinct()->get('siswa')->result();
            foreach($exist_kelas as $k) {
                $this->db->insert('kelas', ['nama_kelas' => $k->kelas]);
            }
        }
    }
}
