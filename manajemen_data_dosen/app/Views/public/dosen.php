<?= view('layout/header') ?>

<div class="container mt-5">
    <h2 class="mb-4">Daftar Dosen</h2>

    <?php if (empty($daftarDosen)): ?>
    <div class="alert alert-warning">Tidak ada data dosen yang tersedia.</div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIDN</th>
                    <th>NIP</th>
                    <th>Gelar</th>
                    <th>Telepon</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($daftarDosen as $dosen): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($dosen['nama']) ?></td>
                    <td><?= esc($dosen['nidn']) ?></td>
                    <td><?= esc($dosen['nip']) ?></td>
                    <td><?= esc($dosen['gelar']) ?></td>
                    <td><?= esc($dosen['telepon']) ?></td>
                    <td><img src="<?= base_url('uploads/' . $dosen['foto']) ?>" width="60"></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<?= view('layout/footer') ?>