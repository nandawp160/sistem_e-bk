<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-secondary">Data Angkatan Siswa</h3>
                <p class="text-muted mb-0 small">Gunakan dropdown di sebelah kanan untuk memfilter data berdasarkan tahun angkatan.</p>
            </div>
            <!-- Dropdown Filter Ringkas -->
            <div class="card border-0 shadow-sm" style="min-width: 200px;">
                <div class="card-body py-2">
                    <label class="form-label small fw-bold text-muted mb-1">Pilih Angkatan</label>
                    <select id="filter-angkatan-dropdown" class="form-select form-select-sm border-0 bg-light fw-bold">
                        <option value="">Semua Angkatan</option>
                        <?php foreach($ringkasan_angkatan as $ra): ?>
                            <option value="<?= $ra->angkatan; ?>">Angkatan <?= $ra->angkatan; ?> (<?= $ra->total; ?> Siswa)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Siswa -->
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="tabel-angkatan">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Angkatan</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas</th>
                            <th>Poin Akumulasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($semua_siswa as $s): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><span class="badge bg-secondary"><?= $s->angkatan; ?></span></td>
                            <td class="fw-bold text-utama"><?= $s->nisn; ?></td>
                            <td><?= $s->nama; ?></td>
                            <td><?= $s->kelas; ?></td>
                            <td>
                                <span class="badge bg-<?= $s->total_poin > 50 ? 'danger' : ($s->total_poin > 0 ? 'warning' : 'success') ?>">
                                    <?= $s->total_poin; ?> Poin
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if($this->session->userdata('role') != 'walikelas'): ?>
                                    <a href="<?= base_url('siswa/edit/'.$s->id); ?>" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                                <?php else: ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#tabel-angkatan').DataTable({
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json"
        }
    });

    // Logika Filter Dropdown
    $('#filter-angkatan-dropdown').on('change', function() {
        var val = $(this).val();
        // Filter pada kolom Angkatan (Index 1)
        table.column(1).search(val).draw();
    });
});
</script>
