<?= view('layout/header') ?>
<div class="container">
    <h3>Tambah Portofolio</h3>
    <form method="post" action="<?= base_url('dosen/portofolio/store') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="pengajaran">Pengajaran</option>
                <option value="penelitian">Penelitian</option>
                <option value="pengabdian">Pengabdian</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('dosen/portofolio') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= view('layout/footer') ?>