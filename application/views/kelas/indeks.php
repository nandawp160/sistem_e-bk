<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold text-secondary">Manajemen Data Kelas</h3>
            <p class="text-muted">Kelola data kelas dan tentukan Wali Kelas untuk masing-masing kelas.</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= base_url('kelas/kosongkan'); ?>" class="btn btn-outline-danger shadow-sm me-2 btn-kosongkan-wali">
                <i class="fas fa-eraser me-2"></i> Kosongkan Wali
            </a>
            <a href="<?= base_url('kelas/acak'); ?>" class="btn btn-outline-primary shadow-sm me-2 btn-acak-wali">
                <i class="fas fa-random me-2"></i> Acak Wali Kelas
            </a>
            <button class="btn btn-utama shadow-sm" data-bs-toggle="modal" data-bs-target="#modalKelas" onclick="tambahKelas()">
                <i class="fas fa-plus me-2"></i> Tambah Kelas Baru
            </button>
        </div>
    </div>

    <?php if($this->session->flashdata('sukses')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> <?= $this->session->flashdata('sukses'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> <?= $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tabel-kelas">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Kelas</th>
                            <th>Wali Kelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($semua_kelas as $k): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-bold"><?= $k->nama_kelas; ?></td>
                            <td>
                                <?php if($k->wali_kelas): ?>
                                    <span class="badge bg-info text-white p-2">
                                        <i class="fas fa-user-tie me-1"></i> <?= $k->wali_kelas; ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-muted small"><i>Belum ditunjuk</i></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn btn-sm btn-warning text-white" 
                                            onclick="editKelas('<?= $k->id; ?>', '<?= $k->nama_kelas; ?>', '<?= $k->walikelas_id; ?>')"
                                            title="Edit Penugasan">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('kelas/hapus/'.$k->id); ?>" class="btn btn-sm btn-danger btn-hapus-kelas" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
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

<!-- Modal Form Kelas -->
<div class="modal fade" id="modalKelas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-utama text-white">
                <h5 class="modal-title" id="modalTitle">Tambah Kelas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('kelas/simpan'); ?>
            <input type="hidden" name="id" id="id_kelas">
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" class="form-control border-0 bg-light" placeholder="Misal: X IPA 1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Tunjuk Wali Kelas</label>
                    <select name="walikelas_id" id="walikelas_id" class="form-select border-0 bg-light">
                        <option value="">-- Pilih Guru --</option>
                        <?php foreach($guru as $g): ?>
                            <option value="<?= $g->id; ?>"><?= $g->nama_lengkap; ?> (<?= str_replace('_', ' ', strtoupper($g->role)); ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-utama">Simpan Data</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
function tambahKelas() {
    $('#modalTitle').text('Tambah Kelas Baru');
    $('#id_kelas').val('');
    $('#nama_kelas').val('');
    $('#walikelas_id').val('');
}

function editKelas(id, nama, wali_id) {
    $('#modalTitle').text('Edit Data Kelas');
    $('#id_kelas').val(id);
    $('#nama_kelas').val(nama);
    $('#walikelas_id').val(wali_id);
    $('#modalKelas').modal('show');
}
</script>
