<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Pelanggaran extends CI_Model {

    public function ambil_semua($kelas = null) {
        $this->_check_column_cetak();
        $this->db->select('pelanggaran.*, siswa.nama, siswa.nisn, siswa.total_poin');
        $this->db->from('pelanggaran');
        $this->db->join('siswa', 'siswa.id = pelanggaran.siswa_id');
        
        if($kelas) {
            $this->db->where('siswa.kelas', $kelas);
        }

        $this->db->order_by('pelanggaran.id', 'DESC');
        return $this->db->get()->result();
    }

    private function _check_column_cetak() {
        if (!$this->db->field_exists('is_cetak', 'pelanggaran')) {
            $this->db->query("ALTER TABLE pelanggaran ADD COLUMN is_cetak INT DEFAULT 0");
        }
    }

    public function ambil_detail($id) {
        $this->db->select('pelanggaran.*, siswa.nama, siswa.nisn, siswa.kelas, siswa.total_poin, siswa.alamat');
        $this->db->from('pelanggaran');
        $this->db->join('siswa', 'siswa.id = pelanggaran.siswa_id');
        $this->db->where('pelanggaran.id', $id);
        return $this->db->get()->row();
    }

    public function tambah($data) {
        // 1. Insert ke tabel pelanggaran
        $this->db->insert('pelanggaran', $data);
        
        // 2. Update total_poin di tabel siswa
        $this->db->set('total_poin', 'total_poin + ' . (int)$data['poin'], FALSE);
        $this->db->where('id', $data['siswa_id']);
        return $this->db->update('siswa');
    }

    public function hapus($id) {
        // 0. Pastikan tabel log ada
        $this->_create_log_table();

        // Ambil data pelanggaran dulu untuk tahu berapa poin yang harus dikurangi
        $p = $this->db->get_where('pelanggaran', ['id' => $id])->row();
        if ($p) {
            // 1. Salin ke log_pelanggaran
            $this->db->query("INSERT INTO log_pelanggaran (pelanggaran_id, siswa_id, nama_pelanggaran, poin, tanggal, keterangan) 
                              VALUES ($p->id, $p->siswa_id, '$p->nama_pelanggaran', $p->poin, '$p->tanggal', '$p->keterangan')");

            // 2. Kurangi poin di tabel siswa
            $this->db->set('total_poin', 'total_poin - ' . (int)$p->poin, FALSE);
            $this->db->where('id', $p->siswa_id);
            $this->db->update('siswa');

            // 3. Hapus data pelanggaran
            $this->db->where('id', $id);
            return $this->db->delete('pelanggaran');
        }
        return FALSE;
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
