<!-- Topbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary d-lg-none">
            <i class="fas fa-align-left"></i>
        </button>
        
        <h5 class="ms-3 mb-0 fw-semibold text-secondary d-none d-md-block">E-BK - SMA NEGERI 1 PRESTASI</h5>

        <div class="ms-auto d-flex align-items-center">
            <div class="me-3 text-end d-none d-sm-block">
                <div class="fw-bold mb-0 lh-1"><?= $this->session->userdata('nama_lengkap') ?? 'Admin TU'; ?></div>
                <small class="text-muted text-capitalize"><?= $this->session->userdata('role') ?? 'Administrator'; ?></small>
            </div>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name=<?= $this->session->userdata('nama_lengkap') ?? 'Admin'; ?>&background=fd7e14&color=fff" alt="User" class="rounded-circle" width="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil Saya</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i> Ganti Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i> Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- End Topbar -->

<div class="main-content">
