<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Edit Profil Dosen</h3>
    <form action="<?= base_url('dosen/profil/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= esc($profil['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($profil['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label>NIDN</label>
            <input type="text" name="nidn" class="form-control" pattern="\d{10}" maxlength="10"
                value="<?= esc($profil['nidn']) ?>" required title="NIDN harus terdiri dari 10 digit angka"
                placeholder="Contoh: 1234567890">
        </div>
        <div class="mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" value="<?= esc($profil['nip']) ?>">
        </div>
        <div class="mb-3">
            <label>Gelar</label>
            <input type="text" name="gelar" class="form-control" value="<?= esc($profil['gelar']) ?>"
                placeholder="Contoh: M.Kom">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= esc($profil['alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" value="<?= esc($profil['telepon']) ?>">
        </div>

        <div class="mb-3">
            <label>Upload Foto Profil</label>
            <input type="file" name="foto" class="form-control">
            <?php if (!empty($profil['foto'])): ?>
            <img src="<?= base_url('uploads/' . $profil['foto']) ?>" width="100" class="mt-2 rounded">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('dosen/profil') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= view('layout/footer') ?>