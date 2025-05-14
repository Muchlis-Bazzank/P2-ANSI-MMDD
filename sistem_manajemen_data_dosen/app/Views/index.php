

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dosen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Daftar Dosen</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <a href="<?= base_url('/dosen/create') ?>" class="btn btn-primary mb-3">Tambah Dosen</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIDN</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($dosen)) : ?>
                <?php $no = 1; foreach ($dosen as $row) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($row['gelar_depan'] . ' ' . $row['nama_lengkap'] . ' ' . $row['gelar_belakang']) ?></td>
                        <td><?= esc($row['nidn']) ?></td>
                        <td><?= esc($row['email_kampus']) ?></td>
                        <td><?= esc($row['no_hp']) ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada data dosen.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

</body>
</html>
