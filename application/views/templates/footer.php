        </div> <!-- End main-content -->
    </div> <!-- End #content -->
</div> <!-- End wrapper -->

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert2 (Opsional tapi bagus untuk UI) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // --- LOGIKA PRELOADER ---
        $(window).on('load', function() {
            $('#preloader').addClass('fade-out');
        });

        // Tampilkan preloader saat pindah halaman (klik link)
        $('a').on('click', function() {
            const href = $(this).attr('href');
            // JANGAN tampilkan preloader jika link memiliki class konfirmasi/sweetalert
            const isConfirm = $(this).hasClass('btn-konfirmasi') || 
                              $(this).hasClass('btn-acak-wali') || 
                              $(this).hasClass('btn-kosongkan-wali') || 
                              $(this).hasClass('btn-reset-password') || 
                              $(this).hasClass('btn-hapus-kelas') || 
                              $(this).hasClass('btn-reset-poin') || 
                              $(this).hasClass('btn-reset-semua') ||
                              $(this).hasClass('btn-logout');

            if (href && href !== '#' && !$(this).attr('target') && !href.startsWith('javascript') && !isConfirm) {
                $('#preloader').removeClass('fade-out');
            }
        });

        $(document).ready(function() {
            // Inisialisasi DataTables Indonesia
            $('#tabel-data').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.4/i18n/id.json",
                    "processing": '<div class="spinner-border text-utama" role="status"><span class="visually-hidden">Loading...</span></div>'
                },
                "processing": true,
                "pageLength": 10,
                "responsive": true
            });

            // Sidebar Toggle
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
                if($('#sidebar').hasClass('active')) {
                    $('#content').css('width', '100%').css('margin-left', '0');
                } else {
                    $('#content').css('width', 'calc(100% - 250px)').css('margin-left', '250px');
                }
            });

            // --- KONFIRMASI RESET POIN (GLOBAL) ---
            $(document).on('click', '.btn-reset-poin', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Reset Poin Siswa?',
                    text: "Poin akan menjadi 0. Riwayat asli akan dipindahkan ke Log Pelanggaran.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fd7e14',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Reset!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            $(document).on('click', '.btn-reset-semua', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Reset SELURUH Poin?',
                    text: "Semua poin akan jadi 0 dan semua riwayat akan dipindahkan ke Log Pelanggaran!",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Reset Semua!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- KONFIRMASI ACAK WALI KELAS ---
            $(document).on('click', '.btn-acak-wali', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Tunjuk Wali Kelas Acak?',
                    text: "Sistem akan menunjuk guru yang tersedia secara acak untuk kelas yang belum memiliki wali.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Acak Sekarang!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- KONFIRMASI KOSONGKAN WALI KELAS ---
            $(document).on('click', '.btn-kosongkan-wali', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Kosongkan Seluruh Wali?',
                    text: "Semua kelas akan menjadi 'Belum ditunjuk'. Tindakan ini tidak dapat dibatalkan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Kosongkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- KONFIRMASI HAPUS KELAS ---
            $(document).on('click', '.btn-hapus-kelas', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Hapus Kelas?',
                    text: "Data kelas akan dihapus permanen dari sistem.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- KONFIRMASI LOGOUT ---
            $(document).on('click', '.btn-logout', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Keluar dari Sistem?',
                    text: "Sesi Anda akan berakhir dan Anda harus login kembali.",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#fd7e14',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Keluar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- KONFIRMASI RESET PASSWORD GURU ---
            $(document).on('click', '.btn-reset-password', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                Swal.fire({
                    title: 'Reset Password User?',
                    text: "Password akan dikembalikan ke default: 123456",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0dcaf0',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Reset!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- KONFIRMASI UMUM (SWEETALERT) ---
            $(document).on('click', '.btn-konfirmasi', function(e) {
                e.preventDefault();
                const url = $(this).attr('href');
                const pesan = $(this).data('pesan') || "Apakah Anda yakin ingin melanjutkan?";
                const judul = $(this).attr('title') || "Konfirmasi Tindakan";

                Swal.fire({
                    title: judul,
                    text: pesan,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fd7e14',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) window.location.href = url;
                });
            });

            // --- FILTER DATATABLES BERDASARKAN KELAS ---
            $('#filter-kelas').on('change', function() {
                const val = $(this).val();
                const table = $('#tabel-data').DataTable();
                table.column(3).search(val).draw();
            });

            // --- FILTER DATATABLES BERDASARKAN AMBANG POIN ---
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    const min = parseInt($('#filter-poin').val(), 10) || 0;
                    const points = parseFloat(data[5]) || 0; // Index 5 adalah kolom Poin

                    if (points >= min) {
                        return true;
                    }
                    return false;
                }
            );

            $('#filter-poin').on('change', function() {
                $('#tabel-data').DataTable().draw();
            });
        });

        // Flash Message SweetAlert
        <?php if($this->session->flashdata('sukses')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $this->session->flashdata('sukses'); ?>',
                confirmButtonColor: '#fd7e14'
            });
        <?php endif; ?>

        <?php if($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= $this->session->flashdata('error'); ?>',
                confirmButtonColor: '#fd7e14'
            });
        <?php endif; ?>
    </script>
</body>
</html>
