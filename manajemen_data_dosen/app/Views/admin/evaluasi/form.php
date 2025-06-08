<?= view('layout/header') ?>

<div class="container mt-4">
    <h2>Input Evaluasi Dosen</h2>
    <form action="<?= base_url(isset($edit) ? 'admin/evaluasi/update/' . $evaluasi['id'] : 'admin/evaluasi/store') ?>"
        method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label>Dosen</label>
            <select name="dosen_id" class="form-select" required>
                <option value="">-- Pilih Dosen --</option>
                <?php foreach ($daftarDosen as $dosen): ?>
                <option value="<?= $dosen['dosen_id'] ?>"
                    <?= isset($evaluasi) && $evaluasi['dosen_id'] == $dosen['dosen_id'] ? 'selected' : '' ?>>
                    <?= esc($dosen['nama']) ?>
                </option>
                <?php endforeach ?>
            </select>

            <input type="date" name="tanggal_evaluasi" class="form-control"
                value="<?= isset($evaluasi['tanggal_evaluasi']) ? esc($evaluasi['tanggal_evaluasi']) : '' ?>" required>

            <input type="number" name="skor" step="0.1" min="0" max="100" class="form-control"
                value="<?= isset($evaluasi['skor']) ? esc($evaluasi['skor']) : '' ?>" required>

        </div>

        <div class="mb-3">
            <label>Tanggal Evaluasi</label>
            <input type="date" name="tanggal_evaluasi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Skor (%)</label>
            <input type="number" name="skor" step="0.1" min="0" max="100" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/evaluasi') ?>" class="btn btn-secondary">Batal</a>
        </>
</div>

<?= view('layout/footer') ?>