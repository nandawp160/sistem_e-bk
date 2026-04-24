<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3 class="fw-bold text-secondary mb-4">Selamat Datang, Admin E-BK!</h3>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-light p-3 rounded-circle me-3">
                        <i class="fas fa-users fa-2x text-oranye"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Total Siswa</h6>
                        <h3 class="fw-bold mb-0"><?= number_format($total_siswa); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-light p-3 rounded-circle me-3">
                        <i class="fas fa-exclamation-circle fa-2x text-danger"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Total Pelanggaran</h6>
                        <h3 class="fw-bold mb-0"><?= number_format($total_pelanggaran); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center">
                    <div class="bg-light p-3 rounded-circle me-3">
                        <i class="fas fa-school fa-2x text-primary"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Kelas Aktif</h6>
                        <h3 class="fw-bold mb-0"><?= $total_kelas; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Tabel Ringkasan Siswa -->
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-header bg-white">
                    <i class="fas fa-trophy me-2 text-warning"></i> Ranking Poin Pelanggaran (Top 5)
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tabel-dashboard">
                            <thead class="table-light">
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama Lengkap</th>
                                    <th>Kelas</th>
                                    <th>Total Poin</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($top_siswa)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data pelanggaran.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1; foreach($top_siswa as $s): ?>
                                    <tr>
                                        <td>
                                            <?php if($no == 1): ?>
                                                <span class="badge bg-danger rounded-circle"><i class="fas fa-crown"></i></span>
                                            <?php elseif($no <= 3): ?>
                                                <span class="badge bg-warning text-dark rounded-circle"><?= $no; ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-light text-dark rounded-circle"><?= $no; ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold"><?= $s->nama; ?></td>
                                        <td><?= $s->kelas; ?></td>
                                        <td>
                                            <span class="fw-bold text-<?= $s->total_poin >= 50 ? 'danger' : 'warning' ?>">
                                                <?= $s->total_poin; ?> Poin
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <?php if($s->total_poin >= 100): ?>
                                                <span class="badge bg-danger">SP 3</span>
                                            <?php elseif($s->total_poin >= 75): ?>
                                                <span class="badge bg-orange text-white" style="background-color: #fd7e14;">SP 2</span>
                                            <?php elseif($s->total_poin >= 50): ?>
                                                <span class="badge bg-warning text-dark">SP 1</span>
                                            <?php else: ?>
                                                <span class="badge bg-success">Aman</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php $no++; endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <div class="col-lg-4">
            <div class="card border-0">
                <div class="card-header bg-white">
                    <i class="fas fa-bell me-2 text-oranye"></i> Aktivitas Terbaru
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-bottom">
                        <?php if(empty($aktivitas_terbaru)): ?>
                            <li class="list-group-item text-center py-4 text-muted small">Belum ada aktivitas.</li>
                        <?php else: ?>
                            <?php foreach($aktivitas_terbaru as $act): ?>
                                <li class="list-group-item border-0 p-3">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1 fw-bold"><?= $act->nama; ?></h6>
                                        <small class="text-muted"><?= date('H:i', strtotime($act->tanggal)); ?></small>
                                    </div>
                                    <p class="mb-1 small text-secondary"><?= $act->nama_pelanggaran; ?></p>
                                    <span class="badge bg-danger rounded-pill fw-normal"><?= $act->poin; ?> Poin</span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
