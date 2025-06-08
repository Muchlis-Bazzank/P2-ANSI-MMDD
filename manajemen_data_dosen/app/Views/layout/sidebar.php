<!-- Tombol toggle sidebar -->
<button class="btn btn-outline-secondary btn-sm m-2 d-md-none" id="toggleSidebar">
    ☰
</button>

<div id="sidebar" class="d-flex flex-column flex-shrink-0 p-3 bg-light"
    style="width: 250px; height: 100vh; position: fixed; transition: all 0.3s;">
    <a href="<?= base_url('/') ?>"
        class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4">Sistem Dosen</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <?php if (session()->get('role') === 'admin'): ?>
        <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link link-dark">Dashboard</a>
        </li>
        <li>
            <a href="<?= base_url('admin/dosen') ?>" class="nav-link link-dark">Kelola Dosen</a>
        </li>
        <?php elseif (session()->get('role') === 'dosen'): ?>
        <li class="nav-item">
            <a href="<?= base_url('dosen/dashboard') ?>" class="nav-link link-dark">Dashboard</a>
        </li>
        <li>
            <a href="<?= base_url('dosen/profil') ?>" class="nav-link link-dark">Profil Saya</a>
        </li>
        <?php endif; ?>
        <li><a href="<?= base_url('auth/logout') ?>" class="nav-link text-danger">Logout</a></li>
    </ul>
    <hr>
    <div class="text-muted small">
        Login sebagai: <strong><?= session('email') ?></strong>
    </div>
</div>