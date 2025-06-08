<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Lengkapi Profil Dosen</h3>
    <?php if (session()->getFlashdata('warning')): ?>
    <div class="alert alert-warning"><?= session()->getFlashdata('warning') ?></div>
    <?php endif; ?>
    <form action="<?= base_url('dosen/lengkapi-profil/simpan') ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control">
        </div>
        <div class="mb-3">
            <label>Gelar</label>
            <input type="text" name="gelar" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

<?= view('layout/footer') ?>