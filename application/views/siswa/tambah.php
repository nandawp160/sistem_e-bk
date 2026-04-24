<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold text-secondary">Tambah Data Siswa</h3>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body p-4">
                    <?= form_open('siswa/tambah'); ?>
                        <div class="mb-3">
                            <label for="nisn" class="form-label fw-semibold">NISN</label>
                            <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan 10 digit NISN" value="<?= set_value('nisn'); ?>">
                            <?= form_error('nisn', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap sesuai ijazah" value="<?= set_value('nama'); ?>">
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="kelas" class="form-label fw-semibold">Kelas / Jurusan</label>
                                <select class="form-select" id="kelas" name="kelas">
                                    <?php foreach($semua_kelas as $k): ?>
                                        <option value="<?= $k->nama_kelas; ?>"><?= $k->nama_kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin</label>
                                <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="angkatan" class="form-label fw-semibold">Tahun Angkatan</label>
                            <input type="number" class="form-control" id="angkatan" name="angkatan" placeholder="Contoh: 2024" value="<?= set_value('angkatan', date('Y')); ?>">
                            <?= form_error('angkatan', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-4">
                            <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat tinggal saat ini"><?= set_value('alamat'); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('siswa'); ?>" class="btn btn-light px-4">Kembali</a>
                            <button type="submit" class="btn btn-utama px-4 shadow-sm">Simpan Data</button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
