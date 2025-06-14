<?= view('layout/header') ?>
<div class="container">
    <h3>Edit Portofolio</h3>
    <form method="post" action="<?= base_url('dosen/portofolio/update/' . $item['id']) ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="pengajaran" <?= $item['kategori'] == 'pengajaran' ? 'selected' : '' ?>>Pengajaran
                </option>
                <option value="penelitian" <?= $item['kategori'] == 'penelitian' ? 'selected' : '' ?>>Penelitian
                </option>
                <option value="pengabdian" <?= $item['kategori'] == 'pengabdian' ? 'selected' : '' ?>>Pengabdian
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($item['judul']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?= esc($item['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="<?= esc($item['tahun']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('dosen/portofolio') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= view('layout/footer') ?>