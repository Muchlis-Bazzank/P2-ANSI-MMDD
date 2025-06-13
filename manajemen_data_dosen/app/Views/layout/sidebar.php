<div class="sidebar">
    <a href="<?= base_url('/') ?>" class="text-white text-decoration-none fs-5 d-block px-3 py-2 fw-bold">Sistem
        Dosen</a>
    <hr class="bg-secondary my-1">

    <ul class="nav nav-pills flex-column mb-auto">
        <?php if (session()->get('role') === 'admin'): ?>
        <li><a href="<?= base_url('admin/dashboard') ?>" class="nav-link text-white">Dashboard</a></li>
        <li><a href="<?= base_url('admin/dosen') ?>" class="nav-link text-white">Kelola Dosen</a></li>
        <?php elseif (session()->get('role') === 'dosen'): ?>
        <li><a href="<?= base_url('dosen/dashboard') ?>" class="nav-link text-white">Dashboard</a></li>
        <li><a href="<?= base_url('dosen/profil') ?>" class="nav-link text-white">Profil Saya</a></li>
        <li><a href="<?= base_url('dosen/ubah-password') ?>" class="nav-link text-white">Ubah Password</a></li>
        <?php endif; ?>
        <li class="mt-2"><a href="<?= base_url('auth/logout') ?>" class="nav-link text-danger">Logout</a></li>
    </ul>

    <hr class="bg-secondary">
    <div class="text-light small px-3">
        Login sebagai: <br><strong><?= esc(session('email')) ?></strong>
    </div>
</div>