<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Ubah Password</h3>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('dosen/ubah-password') ?>">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label>Password Lama</label>
            <input type="password" name="password_lama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password_baru" class="form-control" required minlength="6">
        </div>

        <div class="mb-3">
            <label>Konfirmasi Password Baru</label>
            <input type="password" name="konfirmasi_password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('dosen/dashboard') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= view('layout/footer') ?>