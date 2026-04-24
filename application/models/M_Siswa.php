<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Siswa extends CI_Model {

    public function ambil_semua() {
        $this->_check_column_panggilan();
        return $this->db->get('siswa')->result();
    }

    public function ambil_kelas() {
        $this->db->select('DISTINCT(kelas) as kelas');
        $this->db->order_by('kelas', 'ASC');
        return $this->db->get('siswa')->result();
    }

    public function tambah($data) {
        return $this->db->insert('siswa', $data);
    }

    public function ambil_by_id($id) {
        return $this->db->get_where('siswa', ['id' => $id])->row();
    }

    public function ubah($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('siswa', $data);
    }

    public function hapus($id) {
        $this->db->where('id', $id);
        return $this->db->delete('siswa');
    }

    public function reset_poin($id) {
        // 0. Pastikan tabel log ada
        $this->_create_log_table();

        // 1. Salin data ke log_pelanggaran sebelum dihapus
        $this->db->query("INSERT INTO log_pelanggaran (pelanggaran_id, siswa_id, nama_pelanggaran, poin, tanggal, keterangan) 
                          SELECT id, siswa_id, nama_pelanggaran, poin, tanggal, keterangan 
                          FROM pelanggaran WHERE siswa_id = $id");

        // 2. Reset total_poin siswa jadi 0
        $this->db->where('id', $id);
        $this->db->update('siswa', ['total_poin' => 0]);

        // 3. Hapus riwayat pelanggaran siswa tersebut
        $this->db->where('siswa_id', $id);
        return $this->db->delete('pelanggaran');
    }

    public function reset_semua_poin() {
        // 0. Pastikan tabel log ada
        $this->_create_log_table();

        // 1. Salin SEMUA data ke log_pelanggaran sebelum dihapus
        $this->db->query("INSERT INTO log_pelanggaran (pelanggaran_id, siswa_id, nama_pelanggaran, poin, tanggal, keterangan) 
                          SELECT id, siswa_id, nama_pelanggaran, poin, tanggal, keterangan 
                          FROM pelanggaran");

        // 2. Reset semua total_poin jadi 0
        $this->db->update('siswa', ['total_poin' => 0]);

        // 3. Kosongkan seluruh tabel pelanggaran
        return $this->db->empty_table('pelanggaran');
    }

    public function increment_panggilan($siswa_id) {
        // Tambahkan kolom jika belum ada (safety)
        $this->_check_column_panggilan();
        
        $this->db->set('jumlah_panggilan', 'jumlah_panggilan + 1', FALSE);
        $this->db->where('id', $siswa_id);
        return $this->db->update('siswa');
    }

    private function _check_column_panggilan() {
        if (!$this->db->field_exists('jumlah_panggilan', 'siswa')) {
            $this->db->query("ALTER TABLE siswa ADD COLUMN jumlah_panggilan INT DEFAULT 0");
        }
    }

    private function _create_log_table() {
        $sql = "CREATE TABLE IF NOT EXISTS log_pelanggaran (
            id INT AUTO_INCREMENT PRIMARY KEY,
            pelanggaran_id INT,
            siswa_id INT,
            nama_pelanggaran VARCHAR(255),
            poin INT,
            tanggal DATE,
            keterangan TEXT,
            deleted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        return $this->db->query($sql);
    }
}
