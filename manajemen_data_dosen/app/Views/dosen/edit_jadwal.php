<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Edit Jadwal</h3>
    <form action="<?= base_url('dosen/profil/jadwal/update/' . $jadwal['id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="text" name="mata_kuliah" value="<?= esc($jadwal['mata_kuliah']) ?>" class="form-control mb-2"
            required>
        <select name="hari" class="form-control mb-2" required>
            <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari): ?>
            <option value="<?= $hari ?>" <?= $jadwal['hari'] == $hari ? 'selected' : '' ?>><?= $hari ?></option>
            <?php endforeach ?>
        </select>
        <input type="time" name="jam_mulai" value="<?= esc($jadwal['jam_mulai']) ?>" class="form-control mb-2" required>
        <input type="time" name="jam_selesai" value="<?= esc($jadwal['jam_selesai']) ?>" class="form-control mb-2"
            required>
        <input type="text" name="ruang" value="<?= esc($jadwal['ruang']) ?>" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= base_url('dosen/profil') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?= view('layout/footer') ?>