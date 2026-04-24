<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akademik extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('auth');
        if($this->session->userdata('role') == 'walikelas') redirect('dashboard');
    }

    public function index() {
        $this->_check_column_angkatan();
        $data['judul'] = 'Data Angkatan Siswa';
        
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');

        if($role == 'walikelas') {
            // Ambil kelas yang diampu
            $ampu = $this->db->get_where('kelas', ['walikelas_id' => $user_id])->row();
            $kelas_diampu = $ampu ? $ampu->nama_kelas : '---TIDAK ADA KELAS---';
            
            // Ambil ringkasan angkatan (hanya kelasnya)
            $data['ringkasan_angkatan'] = $this->db->select('angkatan, COUNT(*) as total')
                                                  ->where('kelas', $kelas_diampu)
                                                  ->group_by('angkatan')
                                                  ->order_by('angkatan', 'DESC')
                                                  ->get('siswa')->result();

            // Ambil data siswa untuk tabel (hanya kelasnya)
            $data['semua_siswa'] = $this->db->where('kelas', $kelas_diampu)
                                            ->order_by('angkatan', 'DESC')
                                            ->get('siswa')->result();
        } else {
            // Admin dan Guru BK melihat semua
            $data['ringkasan_angkatan'] = $this->db->select('angkatan, COUNT(*) as total')
                                                  ->group_by('angkatan')
                                                  ->order_by('angkatan', 'DESC')
                                                  ->get('siswa')->result();

            $data['semua_siswa'] = $this->db->order_by('angkatan', 'DESC')->get('siswa')->result();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('akademik/indeks', $data);
        $this->load->view('templates/footer', $data);
    }

    private function _check_column_angkatan() {
        if (!$this->db->field_exists('angkatan', 'siswa')) {
            $this->db->query("ALTER TABLE siswa ADD COLUMN angkatan VARCHAR(4) DEFAULT '2024'");
        }
    }
}
