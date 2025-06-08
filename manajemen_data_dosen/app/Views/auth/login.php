<?= view('layout/header') ?>

<div class="container mt-5">
    <h2 class="mb-4">Login</h2>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->get('isLoggedIn')): ?>
    <div class="alert alert-info">
        Anda sudah login sebagai <strong><?= session()->get('email') ?></strong>.
        <a href="<?= base_url(session()->get('role') . '/dashboard') ?>">Lanjut ke dashboard</a>.
    </div>
    <?php else: ?>
    <form action="<?= base_url('auth/attempt_login') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Masuk</button>
        <a href="<?= base_url('/auth/register') ?>" class="btn btn-link">Belum punya akun? DAFTAR</a>
    </form>
    <?php endif; ?>
</div>

<?= view('layout/footer') ?>