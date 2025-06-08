<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Edit Keahlian</h3>
    <form action="<?= base_url('dosen/profil/keahlian/update/' . $keahlian['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <input type="text" name="nama_keahlian" class="form-control" value="<?= esc($keahlian['nama_keahlian']) ?>"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('dosen/profil') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= view('layout/footer') ?>