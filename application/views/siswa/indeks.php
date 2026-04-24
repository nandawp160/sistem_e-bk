<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold text-secondary">Daftar Data Siswa</h3>
            <div class="d-flex gap-2">
                <?php if($this->session->userdata('role') != 'walikelas'): ?>
                    <a href="<?= base_url('siswa/reset_semua'); ?>" class="btn btn-outline-danger btn-reset-semua shadow-sm">
                        <i class="fas fa-sync-alt me-2"></i> Reset Semua Poin
                    </a>
                    <a href="<?= base_url('siswa/tambah'); ?>" class="btn btn-utama shadow-sm">
                        <i class="fas fa-plus me-2"></i> Tambah Siswa
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2">
                    <label class="form-label small fw-bold text-muted mb-1">Filter Berdasarkan Kelas</label>
                    <select id="filter-kelas" class="form-select form-select-sm border-0 bg-light">
                        <option value="">Semua Kelas</option>
                        <?php foreach($semua_kelas as $k): ?>
                            <option value="<?= $k->kelas; ?>"><?= $k->kelas; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body py-2">
                    <label class="form-label small fw-bold text-muted mb-1">Filter Ambang Poin</label>
                    <select id="filter-poin" class="form-select form-select-sm border-0 bg-light">
                        <option value="0">Semua Poin</option>
                        <option value="25">≥ 25 Poin</option>
                        <option value="50">≥ 50 Poin</option>
                        <option value="80">≥ 80 Poin</option>
                        <option value="100">≥ 100 Poin</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="tabel-data">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas / Jurusan</th>
                            <th>Alamat</th>
                            <th>Poin</th>
                            <th>Panggilan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($semua_siswa as $s): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-bold text-oranye"><?= $s->nisn; ?></td>
                            <td><?= $s->nama; ?></td>
                            <td><?= $s->kelas; ?></td>
                            <td><?= $s->alamat; ?></td>
                            <td>
                                <span class="badge bg-<?= $s->total_poin > 50 ? 'danger' : ($s->total_poin > 20 ? 'warning' : 'success') ?>">
                                    <?= $s->total_poin; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">
                                    <i class="fas fa-bullhorn me-1"></i> <?= $s->jumlah_panggilan; ?>
                                </span>
                            </td>
                            <td class="text-center" style="white-space: nowrap; width: 150px;">
                                <div class="d-flex justify-content-center gap-1">
                                    <?php if($s->total_poin >= 50 && $this->session->userdata('role') != 'admin'): ?>
                                        <a href="<?= base_url('pelanggaran/cetak_surat_siswa/'.$s->id); ?>" target="_blank" class="btn btn-sm btn-info text-white" title="Cetak Surat Akumulasi">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if($this->session->userdata('role') != 'walikelas'): ?>
                                        <a href="<?= base_url('siswa/edit/'.$s->id); ?>" class="btn btn-sm btn-warning text-white" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('siswa/reset_poin/'.$s->id); ?>" class="btn btn-sm btn-primary btn-reset-poin" title="Reset Poin">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                        <a href="<?= base_url('siswa/hapus/'.$s->id); ?>" class="btn btn-sm btn-danger btn-konfirmasi" data-pesan="Seluruh data siswa dan riwayat pelanggarannya akan terhapus secara permanen." title="Hapus Data Siswa">
                                            <i class="fas fa-trash"></i>
                                        </a>
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
