<?= view('layout/header') ?>

<div class="container mt-4">
    <h2>Kelola Dosen</h2>
    <a href="<?= base_url('admin/dosen/create') ?>" class="btn btn-primary mb-3">+ Tambah Dosen</a>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Nama</th>
                <th>NIDN</th>
                <th>NIP</th>
                <th>Gelar</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarDosen as $dosen): ?>
            <tr>
                <td><?= esc($dosen['nama']) ?></td>
                <td><?= esc($dosen['nidn']) ?></td>
                <td><?= esc($dosen['nip']) ?></td>
                <td><?= esc($dosen['gelar']) ?></td>
                <td><?= esc($dosen['email']) ?></td>
                <td><?= esc($dosen['telepon']) ?></td>
                <td>
                    <a href="<?= base_url('admin/dosen/edit/' . $dosen['id']) ?>"
                        class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('admin/dosen/delete/' . $dosen['id']) ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus dosen ini?')">Hapus</a>
                    <a href="<?= base_url('admin/dosen/reset-password-form/' . $dosen['id']) ?>"
                        class="btn btn-sm btn-secondary">Reset Password</a>

                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= view('layout/footer') ?>