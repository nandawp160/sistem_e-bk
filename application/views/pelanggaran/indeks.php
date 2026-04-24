<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold text-secondary">Data Kedisiplinan Siswa</h3>
            <!-- Tombol sekarang membuka Modal -->
            <?php if($this->session->userdata('role') != 'walikelas'): ?>
                <button type="button" class="btn btn-utama shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggaran">
                    <i class="fas fa-plus me-2"></i> Input Pelanggaran
                </button>
            <?php endif; ?>
        </div>
    </div>

    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="tabel-data">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Pelanggaran</th>
                            <th>Poin</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($semua_pelanggaran as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= date('d/m/Y', strtotime($p->tanggal)); ?></td>
                            <td class="text-oranye fw-bold"><?= $p->nisn; ?></td>
                            <td><?= $p->nama; ?></td>
                            <td><?= $p->nama_pelanggaran; ?></td>
                            <td><span class="badge bg-danger"><?= $p->poin; ?></span></td>
                            <td class="text-center" style="white-space: nowrap;">
                                <div class="d-flex justify-content-center gap-1">
                                    <?php if($p->is_cetak == 1 && $this->session->userdata('role') != 'admin'): ?>
                                        <a href="<?= base_url('pelanggaran/cetak_surat/'.$p->id); ?>" target="_blank" class="btn btn-sm btn-info text-white" title="Cetak Surat Pemanggilan">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($this->session->userdata('role') != 'walikelas'): ?>
                                        <a href="#" class="btn btn-sm btn-warning text-white" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="<?= base_url('pelanggaran/hapus/'.$p->id); ?>" class="btn btn-sm btn-danger btn-konfirmasi" data-pesan="Data pelanggaran ini akan dihapus secara permanen." title="Hapus Pelanggaran"><i class="fas fa-trash"></i></a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Input Pelanggaran -->
<div class="modal fade" id="modalTambahPelanggaran" tabindex="-1" aria-labelledby="modalTambahPelanggaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-utama text-white">
                <h5 class="modal-title" id="modalTambahPelanggaranLabel"><i class="fas fa-exclamation-triangle me-2"></i> Input Pelanggaran Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('pelanggaran/tambah'); ?>
            <div class="modal-body p-4">
                <div class="row g-3">
                    <!-- Filter Kelas -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Filter Kelas</label>
                        <select id="modal-filter-kelas" class="form-select border-0 bg-light">
                            <option value="">-- Semua Kelas --</option>
                            <?php foreach($semua_kelas as $k): ?>
                                <option value="<?= $k->kelas; ?>"><?= $k->kelas; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Pilih Siswa -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Pilih Siswa <span class="text-danger">*</span></label>
                        <select name="siswa_id" id="modal-pilih-siswa" class="form-select border-0 bg-light" required>
                            <option value="">-- Pilih Siswa --</option>
                            <?php foreach($semua_siswa as $s): ?>
                                <option value="<?= $s->id; ?>" data-kelas="<?= $s->kelas; ?>">
                                    <?= $s->nama; ?> (<?= $s->kelas; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Jenis Pelanggaran -->
                    <div class="col-12">
                        <label class="form-label fw-bold small text-muted">Jenis Pelanggaran <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pelanggaran" class="form-control border-0 bg-light" placeholder="Contoh: Terlambat, Atribut tidak lengkap" required>
                    </div>

                    <!-- Poin -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Poin Pelanggaran <span class="text-danger">*</span></label>
                        <input type="number" name="poin" class="form-control border-0 bg-light" placeholder="Contoh: 5, 10, 20" required>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-muted">Tanggal Kejadian <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control border-0 bg-light" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="col-12">
                        <label class="form-label fw-bold small text-muted">Keterangan Tambahan</label>
                        <textarea name="keterangan" class="form-control border-0 bg-light" rows="3" placeholder="Detail kejadian (opsional)"></textarea>
                    </div>

                    <!-- Checklist Cetak Surat -->
                    <div class="col-12">
                        <div class="form-check form-switch p-3 bg-light rounded border border-warning shadow-sm">
                            <input class="form-check-input ms-0 me-2" type="checkbox" name="is_cetak" id="is_cetak" value="1">
                            <label class="form-check-label fw-bold text-danger" for="is_cetak">
                                Terbitkan Surat Pemanggilan Orang Tua untuk pelanggaran ini?
                            </label>
                            <div class="small text-muted ms-4 ps-1">Aktifkan jika pelanggaran sangat berat dan butuh penanganan segera.</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0 p-3">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-utama px-4 shadow-sm">Simpan Catatan</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Logika Filter Bertingkat di Modal
    $('#modal-filter-kelas').on('change', function() {
        var kelasTerpilih = $(this).val();
        
        $('#modal-pilih-siswa option').each(function() {
            var kelasSiswa = $(this).data('kelas');
            
            if (kelasTerpilih === "" || kelasSiswa === kelasTerpilih) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        
        // Reset pilihan siswa jika kelas diganti
        $('#modal-pilih-siswa').val("");
    });
});
</script>
