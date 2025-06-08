<?= view('layout/header') ?>

<div class="container mt-4">
    <h2><?= isset($edit) ? 'Edit' : 'Tambah' ?> Dosen</h2>

    <form action="<?= base_url(isset($edit) ? 'admin/dosen/update/' . $dosen['id'] : 'admin/dosen/store') ?>"
        method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= esc($dosen['nama'] ?? '') ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($dosen['email'] ?? '') ?>" required>
        </div>
        <?php if (!isset($edit)): ?>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <?php endif; ?>
        <div class="mb-3">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control" value="<?= esc($dosen['nidn'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="<?= esc($dosen['nip'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Gelar</label>
            <input type="text" name="gelar" class="form-control" value="<?= esc($dosen['gelar'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= esc($dosen['telepon'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= esc($dosen['alamat'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/dosen') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= view('layout/footer') ?>