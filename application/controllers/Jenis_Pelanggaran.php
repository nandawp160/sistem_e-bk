<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_Pelanggaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) redirect('auth');
        if($this->session->userdata('role') != 'admin') redirect('dashboard');
        $this->load->model('M_Jenis_Pelanggaran');
    }

    public function index() {
        $data['judul'] = 'Master Jenis Pelanggaran';
        $data['semua_jenis'] = $this->M_Jenis_Pelanggaran->ambil_semua();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('jenis_pelanggaran/indeks', $data);
        $this->load->view('templates/footer', $data);
    }

    public function simpan() {
        $id = $this->input->post('id');
        $data = [
            'nama_pelanggaran' => $this->input->post('nama_pelanggaran'),
            'kategori' => $this->input->post('kategori'),
            'poin' => $this->input->post('poin')
        ];

        if ($id) {
            $this->M_Jenis_Pelanggaran->ubah($id, $data);
            $this->session->set_flashdata('sukses', 'Jenis pelanggaran berhasil diperbarui.');
        } else {
            $this->M_Jenis_Pelanggaran->tambah($data);
            $this->session->set_flashdata('sukses', 'Jenis pelanggaran baru berhasil ditambahkan.');
        }
        redirect('jenis_pelanggaran');
    }

    public function hapus($id) {
        $this->M_Jenis_Pelanggaran->hapus($id);
        $this->session->set_flashdata('sukses', 'Jenis pelanggaran berhasil dihapus.');
        redirect('jenis_pelanggaran');
    }
}
