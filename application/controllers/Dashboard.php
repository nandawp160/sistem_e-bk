<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Nanti aktifkan cek login di sini
        // if(!$this->session->userdata('logged_in')) redirect('auth');
    }

    public function index() {
        $data['judul'] = 'Beranda';
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');

        if($role == 'walikelas') {
            $ampu = $this->db->get_where('kelas', ['walikelas_id' => $user_id])->row();
            $kelas_diampu = $ampu ? $ampu->nama_kelas : '---TIDAK ADA KELAS---';
            
            $data['total_siswa'] = $this->db->get_where('siswa', ['kelas' => $kelas_diampu])->num_rows();
            $data['total_pelanggaran'] = $this->db->join('siswa', 'siswa.id = pelanggaran.siswa_id')->get_where('pelanggaran', ['siswa.kelas' => $kelas_diampu])->num_rows();
            $data['total_kelas'] = 1; // Karena dia hanya pegang 1 kelas
            
            // Ambil Ranking Siswa (hanya kelasnya)
            $data['top_siswa'] = $this->db->where('kelas', $kelas_diampu)->order_by('total_poin', 'DESC')->limit(5)->get('siswa')->result();
            
            // Aktivitas Terbaru (hanya kelasnya)
            $this->db->select('pelanggaran.*, siswa.nama');
            $this->db->from('pelanggaran');
            $this->db->join('siswa', 'siswa.id = pelanggaran.siswa_id');
            $this->db->where('siswa.kelas', $kelas_diampu);
            $this->db->order_by('pelanggaran.id', 'DESC');
            $this->db->limit(5);
            $data['aktivitas_terbaru'] = $this->db->get()->result();

        } else {
            $data['total_siswa'] = $this->db->count_all('siswa');
            $data['total_pelanggaran'] = $this->db->count_all('pelanggaran');
            $data['total_kelas'] = $this->db->select('kelas')->distinct()->get('siswa')->num_rows();
            
            $data['top_siswa'] = $this->db->order_by('total_poin', 'DESC')->limit(5)->get('siswa')->result();

            $this->db->select('pelanggaran.*, siswa.nama');
            $this->db->from('pelanggaran');
            $this->db->join('siswa', 'siswa.id = pelanggaran.siswa_id');
            $this->db->order_by('pelanggaran.id', 'DESC');
            $this->db->limit(5);
            $data['aktivitas_terbaru'] = $this->db->get()->result();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer', $data);
    }
}
