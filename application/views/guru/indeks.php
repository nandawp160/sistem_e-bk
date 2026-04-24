<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h3 class="fw-bold text-secondary">Manajemen Data Guru & Staf</h3>
            <p class="text-muted">Kelola akun pengguna sistem (Admin, Guru BK, dan Wali Kelas).</p>
        </div>
        <div class="col-md-6 text-end">
            <button class="btn btn-utama shadow-sm" data-bs-toggle="modal" data-bs-target="#modalGuru" onclick="tambahGuru()">
                <i class="fas fa-user-plus me-2"></i> Tambah User Baru
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tabel-guru">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role / Jabatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($semua_guru as $g): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="fw-bold text-oranye"><?= $g->username; ?></td>
                            <td><?= $g->nama_lengkap; ?></td>
                            <td>
                                <?php if($g->role == 'admin'): ?>
                                    <span class="badge bg-danger">Administrator</span>
                                <?php elseif($g->role == 'guru_bk'): ?>
                                    <span class="badge bg-primary">Guru BK</span>
                                <?php else: ?>
                                    <span class="badge bg-info">Wali Kelas</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= base_url('guru/reset_password/'.$g->id); ?>" 
                                       class="btn btn-sm btn-info text-white btn-reset-password" 
                                       title="Reset Password Default (123456)">
                                        <i class="fas fa-key"></i>
                                    </a>
                                    <button class="btn btn-sm btn-warning text-white" 
                                            onclick="editGuru('<?= $g->id; ?>', '<?= $g->username; ?>', '<?= $g->nama_lengkap; ?>', '<?= $g->role; ?>')"
                                            title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <a href="<?= base_url('guru/hapus/'.$g->id); ?>" class="btn btn-sm btn-danger btn-konfirmasi" data-pesan="Akun guru ini akan dihapus dan tidak bisa digunakan untuk login lagi." title="Hapus Akun Guru">
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

<!-- Modal Form Guru -->
<div class="modal fade" id="modalGuru" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-utama text-white">
                <h5 class="modal-title" id="modalTitle">Tambah User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('guru/simpan'); ?>
            <input type="hidden" name="id" id="id_guru">
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control border-0 bg-light" placeholder="Nama Beserta Gelar" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Username</label>
                    <input type="text" name="username" id="username" class="form-control border-0 bg-light" placeholder="Untuk login" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Password</label>
                    <input type="password" name="password" id="password" class="form-control border-0 bg-light" placeholder="Isi hanya jika ingin ganti password">
                    <small class="text-muted" id="passHelp" style="display:none;">*Kosongkan jika tidak ingin merubah password</small>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold small text-muted">Role / Jabatan</label>
                    <select name="role" id="role" class="form-select border-0 bg-light" required>
                        <option value="admin">Administrator</option>
                        <option value="guru_bk">Guru BK</option>
                        <option value="walikelas">Wali Kelas</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-utama">Simpan User</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
function tambahGuru() {
    $('#modalTitle').text('Tambah User Baru');
    $('#id_guru').val('');
    $('#nama_lengkap').val('');
    $('#username').val('');
    $('#password').val('');
    $('#role').val('walikelas');
    $('#passHelp').hide();
    $('#password').attr('required', true);
}

function editGuru(id, user, nama, role) {
    $('#modalTitle').text('Edit Data Guru');
    $('#id_guru').val(id);
    $('#username').val(user);
    $('#nama_lengkap').val(nama);
    $('#role').val(role);
    $('#password').val('');
    $('#passHelp').show();
    $('#password').attr('required', false);
    $('#modalGuru').modal('show');
}
</script>
