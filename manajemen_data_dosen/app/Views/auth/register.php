<?= view('layout/header') ?>

<div class="container mt-5">
    <h2 class="mb-4">Registrasi Dosen</h2>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('auth/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input id="nama" type="text" name="nama" value="<?= old('nama') ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" value="<?= old('email') ?>" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Daftar</button>
        <a href="<?= base_url('auth/login') ?>" class="btn btn-link">Sudah punya akun? MASUK</a>
    </form>
</div>

<?= view('layout/footer') ?>