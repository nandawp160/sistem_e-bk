<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $judul ?></h1>
        <button type="button" class="btn btn-oranye shadow-sm" data-bs-toggle="modal" data-bs-target="#modalJenis">
            <i class="fas fa-plus fa-sm text-white-50 me-1"></i> Tambah Jenis Pelanggaran
        </button>
    </div>

    <?php if($this->session->flashdata('sukses')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('sukses') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Pelanggaran</th>
                            <th>Kategori</th>
                            <th width="15%">Poin Standar</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($semua_jenis as $j): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $j->nama_pelanggaran ?></td>
                            <td>
                                <span class="badge bg-<?= $j->kategori == 'Berat' ? 'danger' : ($j->kategori == 'Sedang' ? 'warning' : 'info') ?>">
                                    <?= $j->kategori ?>
                                </span>
                            </td>
                            <td class="fw-bold text-danger"><?= $j->poin ?> Poin</td>
                            <td>
                                <button class="btn btn-sm btn-info text-white btn-edit" 
                                    data-id="<?= $j->id ?>" 
                                    data-nama="<?= $j->nama_pelanggaran ?>" 
                                    data-kategori="<?= $j->kategori ?>" 
                                    data-poin="<?= $j->poin ?>"
                                    data-bs-toggle="modal" data-bs-target="#modalJenis">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="<?= base_url('jenis_pelanggaran/hapus/'.$j->id) ?>" class="btn btn-sm btn-danger btn-hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalJenis" tabindex="-1" aria-labelledby="modalJenisLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-oranye text-white">
                <h5 class="modal-title" id="modalJenisLabel">Tambah Jenis Pelanggaran</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('jenis_pelanggaran/simpan') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id" id="id_jenis">
                    <div class="mb-3">
                        <label for="nama_pelanggaran" class="form-label">Nama Pelanggaran</label>
                        <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" required placeholder="Contoh: Terlambat Masuk">
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori" id="kategori" required>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="poin" class="form-label">Poin Standar</label>
                        <input type="number" class="form-control" id="poin" name="poin" required min="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-oranye">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle Edit Button
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const kategori = this.getAttribute('data-kategori');
            const poin = this.getAttribute('data-poin');

            document.getElementById('modalJenisLabel').innerText = 'Edit Jenis Pelanggaran';
            document.getElementById('id_jenis').value = id;
            document.getElementById('nama_pelanggaran').value = nama;
            document.getElementById('kategori').value = kategori;
            document.getElementById('poin').value = poin;
        });
    });

    // Reset Modal on Close
    const modalElement = document.getElementById('modalJenis');
    modalElement.addEventListener('hidden.bs.modal', function () {
        document.getElementById('modalJenisLabel').innerText = 'Tambah Jenis Pelanggaran';
        document.getElementById('id_jenis').value = '';
        document.getElementById('nama_pelanggaran').value = '';
        document.getElementById('kategori').value = 'Ringan';
        document.getElementById('poin').value = '';
    });

    // Handle Delete Confirmation
    const hapusButtons = document.querySelectorAll('.btn-hapus');
    hapusButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if(!confirm('Apakah Anda yakin ingin menghapus jenis pelanggaran ini?')) {
                e.preventDefault();
            }
        });
    });
});
</script>
