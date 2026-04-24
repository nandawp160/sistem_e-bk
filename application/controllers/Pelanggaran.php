<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('auth');
        if($this->session->userdata('role') == 'admin') redirect('dashboard');
        $this->load->model(['M_Pelanggaran', 'M_Siswa']);
    }

    public function index() {
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        
        if($role == 'walikelas') {
            $ampu = $this->db->get_where('kelas', ['walikelas_id' => $user_id])->row();
            $kelas_diampu = $ampu ? $ampu->nama_kelas : '---TIDAK ADA KELAS---';
            
            $data['semua_pelanggaran'] = $this->M_Pelanggaran->ambil_semua($kelas_diampu);
            $data['semua_siswa'] = $this->db->get_where('siswa', ['kelas' => $kelas_diampu])->result();
            $data['semua_kelas'] = $this->db->select('kelas')->distinct()->where('kelas', $kelas_diampu)->get('siswa')->result();
        } else {
            $data['semua_pelanggaran'] = $this->M_Pelanggaran->ambil_semua();
            $data['semua_siswa'] = $this->M_Siswa->ambil_semua();
            $data['semua_kelas'] = $this->M_Siswa->ambil_kelas();
        }

        $data['judul'] = 'Data Kedisiplinan Siswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggaran/indeks', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah() {
        $data['judul'] = 'Input Pelanggaran Siswa';
        $data['semua_siswa'] = $this->M_Siswa->ambil_semua();
        $data['semua_kelas'] = $this->M_Siswa->ambil_kelas();

        $this->form_validation->set_rules('siswa_id', 'Siswa', 'required');
        $this->form_validation->set_rules('nama_pelanggaran', 'Nama Pelanggaran', 'required');
        $this->form_validation->set_rules('poin', 'Poin', 'required|numeric');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('pelanggaran/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $simpan_data = [
                'siswa_id' => $this->input->post('siswa_id'),
                'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
                'poin' => $this->input->post('poin'),
                'tanggal' => $this->input->post('tanggal'),
                'keterangan' => $this->input->post('keterangan'),
                'is_cetak' => $this->input->post('is_cetak') ? 1 : 0
            ];
            $this->M_Pelanggaran->tambah($simpan_data);
            $this->session->set_flashdata('sukses', 'Data pelanggaran berhasil dicatat.');
            redirect('pelanggaran');
        }
    }

    public function hapus($id) {
        $this->M_Pelanggaran->hapus($id);
        $this->session->set_flashdata('sukses', 'Data pelanggaran telah dihapus.');
        redirect('pelanggaran');
    }

    public function cetak_surat($id) {
        $data['p'] = $this->M_Pelanggaran->ambil_detail($id);
        if (!$data['p']) {
            show_404();
        }

        // Tambah jumlah pemanggilan orang tua (+1)
        $this->M_Siswa->increment_panggilan($data['p']->siswa_id);

        $data['judul'] = 'Surat Pemanggilan Orang Tua';
        $this->load->view('pelanggaran/surat', $data);
    }

    public function cetak_surat_siswa($siswa_id) {
        // Ambil data siswa
        $this->db->where('id', $siswa_id);
        $data['siswa'] = $this->db->get('siswa')->row();
        
        if (!$data['siswa']) {
            show_404();
        }

        // Ambil semua riwayat pelanggaran siswa ini
        $this->db->where('siswa_id', $siswa_id);
        $this->db->order_by('tanggal', 'DESC');
        $data['riwayat'] = $this->db->get('pelanggaran')->result();

        // Tambah jumlah pemanggilan orang tua (+1)
        $this->M_Siswa->increment_panggilan($siswa_id);

        $data['judul'] = 'Surat Pemanggilan Akumulasi Poin';
        $this->load->view('pelanggaran/surat_akumulasi', $data);
    }
}
