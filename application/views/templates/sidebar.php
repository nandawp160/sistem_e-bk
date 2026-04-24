<!-- Sidebar -->
<nav id="sidebar">
    <div class="sidebar-header">
        <img src="https://ui-avatars.com/api/?name=SIAKAD&background=fd7e14&color=fff" alt="Logo Sekolah">
        <h5 class="mt-2 fw-bold text-white">E-BK SMA</h5>
        <small class="opacity-75">SMA NEGERI 1 PRESTASI</small>
    </div>

    <ul class="list-unstyled components">
        <li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
            <a href="<?= base_url('dashboard') ?>"><i class="fas fa-th-large"></i> Dashboard</a>
        </li>
        <li class="<?= $this->uri->segment(1) == 'siswa' ? 'active' : '' ?>">
            <a href="<?= base_url('siswa') ?>"><i class="fas fa-user-graduate"></i> Data Siswa</a>
        </li>
        <?php if($this->session->userdata('role') == 'admin'): ?>
        <li class="<?= $this->uri->segment(1) == 'kelas' ? 'active' : '' ?>">
            <a href="<?= base_url('kelas') ?>"><i class="fas fa-chalkboard-teacher"></i> Data Kelas</a>
        </li>
        <li class="<?= $this->uri->segment(1) == 'guru' ? 'active' : '' ?>">
            <a href="<?= base_url('guru') ?>"><i class="fas fa-user-tie"></i> Data Guru</a>
        </li>
        <?php endif; ?>
        <?php if($this->session->userdata('role') != 'admin'): ?>
        <li class="<?= $this->uri->segment(1) == 'pelanggaran' ? 'active' : '' ?>">
            <a href="<?= base_url('pelanggaran') ?>"><i class="fas fa-exclamation-triangle"></i> Kedisiplinan</a>
        </li>
        <?php endif; ?>
        <?php if($this->session->userdata('role') != 'walikelas'): ?>
        <li class="<?= $this->uri->segment(1) == 'akademik' ? 'active' : '' ?>">
            <a href="<?= base_url('akademik') ?>"><i class="fas fa-graduation-cap"></i> Data Angkatan</a>
        </li>
        <?php endif; ?>
    </ul>

    <div class="px-4 mt-5">
        <a href="<?= base_url('auth/logout') ?>" class="btn btn-light btn-sm w-100 text-oranye fw-bold btn-logout">
            <i class="fas fa-sign-out-alt me-2"></i> Keluar
        </a>
    </div>
</nav>
<!-- End Sidebar -->

<!-- Content Area -->
<div id="content">
