<?= view('layout/header') ?>

<div class="container mt-4">
    <h2>Reset Password: <?= esc($dosen['nama']) ?></h2>

    <form action="<?= base_url('admin/dosen/reset-password/' . $dosen['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <button type="submit" class="btn btn-danger">Reset Password</button>
        <a href="<?= base_url('admin/dosen') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= view('layout/footer') ?>