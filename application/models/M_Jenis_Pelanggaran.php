<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jenis_Pelanggaran extends CI_Model {

    private $table = 'jenis_pelanggaran';

    public function ambil_semua() {
        return $this->db->get($this->table)->result();
    }

    public function ambil_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function tambah($data) {
        return $this->db->insert($this->table, $data);
    }

    public function ubah($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function hapus($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
