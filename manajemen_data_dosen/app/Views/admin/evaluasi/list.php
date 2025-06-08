<?= view('layout/header') ?>

< class="container mt-4">
    <h2>Daftar Evaluasi Dosen</h2>
    <a href="<?= base_url('admin/evaluasi/create') ?>" class="btn btn-primary mb-3">+ Tambah Evaluasi</a>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nama Dosen</th>
                <th>Tanggal</th>
                <th>Skor (%)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evaluasi as $e): ?>
            <tr>
                <td><?= esc($e['nama']) ?></td>
                <td><?= date('d M Y', strtotime($e['tanggal_evaluasi'])) ?></td>
                <td><?= esc($e['skor']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <td>
        <a href="<?= base_url('admin/evaluasi/edit/' . $e['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="<?= base_url('admin/evaluasi/delete/' . $e['id']) ?>" class="btn btn-sm btn-danger"
            onclick="return confirm('Yakin hapus evaluasi ini?')">Hapus</a>
    </td>
</>

<?= view('layout/footer') ?>