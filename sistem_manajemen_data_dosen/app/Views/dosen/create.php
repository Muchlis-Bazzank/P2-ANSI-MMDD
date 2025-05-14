<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Dosen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">Form Tambah Dosen</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('/dosen/store') ?>" method="post">
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">NIDN</label>
            <div class="col-sm-10">
                <input type="text" name="nidn" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Gelar Depan</label>
            <div class="col-sm-10">
                <input type="text" name="gelar_depan" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Gelar Belakang</label>
            <div class="col-sm-10">
                <input type="text" name="gelar_belakang" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
            <div class="col-sm-10">
                <select name="jenis_kelamin" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="date" name="tanggal_lahir" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <textarea name="alamat" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">No HP</label>
            <div class="col-sm-10">
                <input type="text" name="no_hp" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Email Kampus</label>
            <div class="col-sm-10">
                <input type="email" name="email_kampus" class="form-control">
            </div>
        </div>

        <!-- Tombol -->
        <div class="text-end">
            <a href="<?= base_url('/dosen') ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

</body>
</html>
