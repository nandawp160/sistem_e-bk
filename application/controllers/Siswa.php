<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Siswa');
    }

    public function index() {
        $role = $this->session->userdata('role');
        $user_id = $this->session->userdata('user_id');
        
        if($role == 'walikelas') {
            // Ambil kelas yang diampu
            $ampu = $this->db->get_where('kelas', ['walikelas_id' => $user_id])->row();
            $kelas_diampu = $ampu ? $ampu->nama_kelas : '---TIDAK ADA KELAS---';
            
            $data['semua_siswa'] = $this->db->get_where('siswa', ['kelas' => $kelas_diampu])->result();
            $data['semua_kelas'] = $this->db->select('kelas')->distinct()->where('kelas', $kelas_diampu)->get('siswa')->result();
        } else {
            $data['semua_siswa'] = $this->db->get('siswa')->result();
            $data['semua_kelas'] = $this->db->select('kelas')->distinct()->get('siswa')->result();
        }

        $data['judul'] = 'Daftar Data Siswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('siswa/indeks', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah() {
        $data['judul'] = 'Tambah Data Siswa';
        $data['semua_kelas'] = $this->db->get('kelas')->result();

        // Validasi Form
        $this->form_validation->set_rules('nisn', 'NISN', 'required|is_unique[siswa.nisn]');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/tambah', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $simpan_data = [
                'nisn' => $this->input->post('nisn'),
                'nama' => $this->input->post('nama'),
                'kelas' => $this->input->post('kelas'),
                'angkatan' => $this->input->post('angkatan'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->M_Siswa->tambah($simpan_data);
            $this->session->set_flashdata('sukses', 'Data siswa berhasil ditambahkan.');
            redirect('siswa');
        }
    }

    public function edit($id) {
        $data['judul'] = 'Edit Data Siswa';
        $data['s'] = $this->M_Siswa->ambil_by_id($id);
        $data['semua_kelas'] = $this->db->get('kelas')->result();

        if (!$data['s']) show_404();

        // Validasi Form
        $this->form_validation->set_rules('nisn', 'NISN', 'required');
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('siswa/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $simpan_data = [
                'nisn' => $this->input->post('nisn'),
                'nama' => $this->input->post('nama'),
                'kelas' => $this->input->post('kelas'),
                'angkatan' => $this->input->post('angkatan'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->M_Siswa->ubah($id, $simpan_data);
            $this->session->set_flashdata('sukses', 'Data siswa berhasil diperbarui.');
            redirect('siswa');
        }
    }

    public function hapus($id) {
        $this->M_Siswa->hapus($id);
        $this->session->set_flashdata('sukses', 'Data siswa berhasil dihapus.');
        redirect('siswa');
    }

    public function reset_poin($id) {
        $this->M_Siswa->reset_poin($id);
        $this->session->set_flashdata('sukses', 'Poin siswa telah direset menjadi 0.');
        redirect('siswa');
    }

    public function reset_semua() {
        $this->M_Siswa->reset_semua_poin();
        $this->session->set_flashdata('sukses', 'Seluruh poin siswa dan riwayat pelanggaran telah direset.');
        redirect('siswa');
    }
}
