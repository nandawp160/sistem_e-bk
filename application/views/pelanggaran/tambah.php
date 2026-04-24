<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold text-secondary">Input Pelanggaran Siswa</h3>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0">
                <div class="card-body p-4">
                    <?= form_open('pelanggaran/tambah'); ?>
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="filter_kelas" class="form-label fw-semibold">Filter Kelas</label>
                                <select class="form-select" id="filter_kelas">
                                    <option value="">-- Semua Kelas --</option>
                                    <?php foreach($semua_kelas as $k): ?>
                                        <option value="<?= $k->kelas; ?>"><?= $k->kelas; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-7">
                                <label for="siswa_id" class="form-label fw-semibold">Pilih Siswa</label>
                                <select class="form-select" id="siswa_id" name="siswa_id">
                                    <option value="" data-kelas="">-- Pilih Siswa --</option>
                                    <?php foreach($semua_siswa as $s): ?>
                                        <option value="<?= $s->id; ?>" data-kelas="<?= $s->kelas; ?>" <?= set_select('siswa_id', $s->id); ?>>
                                            <?= $s->nisn; ?> - <?= $s->nama; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('siswa_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="mb-3">

                        <div class="mb-3">
                            <label for="nama_pelanggaran" class="form-label fw-semibold">Jenis Pelanggaran</label>
                            <input type="text" class="form-control" id="nama_pelanggaran" name="nama_pelanggaran" placeholder="Contoh: Terlambat, Atribut tidak lengkap" value="<?= set_value('nama_pelanggaran'); ?>">
                            <?= form_error('nama_pelanggaran', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="poin" class="form-label fw-semibold">Poin Pelanggaran</label>
                                <input type="number" class="form-control" id="poin" name="poin" placeholder="Contoh: 5, 10, 20" value="<?= set_value('poin'); ?>">
                                <?= form_error('poin', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal" class="form-label fw-semibold">Tanggal Kejadian</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d'); ?>">
                                <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan Tambahan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Detail kejadian (opsional)"><?= set_value('keterangan'); ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?= base_url('pelanggaran'); ?>" class="btn btn-light px-4">Kembali</a>
                            <button type="submit" class="btn btn-utama px-4 shadow-sm">Simpan Catatan</button>
                        </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    const $filterKelas = $('#filter_kelas');
    const $siswaSelect = $('#siswa_id');
    const $originalOptions = $siswaSelect.find('option').clone();

    $filterKelas.on('change', function() {
        const selectedKelas = $(this).val();
        
        // Simpan pilihan saat ini (jika ada)
        const currentSelected = $siswaSelect.val();
        
        // Reset dropdown siswa
        $siswaSelect.empty();
        
        if (selectedKelas === "") {
            // Jika semua kelas, tampilkan semua opsi
            $siswaSelect.append($originalOptions.clone());
        } else {
            // Tampilkan opsi default dan yang sesuai kelas
            const $filtered = $originalOptions.filter(function() {
                return $(this).data('kelas') === "" || $(this).data('kelas') == selectedKelas;
            });
            $siswaSelect.append($filtered.clone());
        }

        // Kembalikan pilihan jika masih ada di list yang difilter
        if ($siswaSelect.find(`option[value="${currentSelected}"]`).length > 0) {
            $siswaSelect.val(currentSelected);
        } else {
            $siswaSelect.val("");
        }
    });
});
</script>
