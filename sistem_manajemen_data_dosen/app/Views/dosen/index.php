<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Dosen</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.css') ?>">
</head>
<body class="container mt-5">
    <h2>Daftar Dosen</h2>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIDN</th>
                <th>Email Kampus</th>
                <th>No. HP</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dosen as $d): ?>
                <tr>
                    <td><?= esc($d['gelar_depan'] . ' ' . $d['nama_lengkap'] . ' ' . $d['gelar_belakang']) ?></td>
                    <td><?= esc($d['nidn']) ?></td>
                    <td><?= esc($d['email_kampus']) ?></td>
                    <td><?= esc($d['no_hp']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIDN</th>
            <th>Jabatan</th>
            <th>Email Kampus</th>
            <th>No. HP</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dosen as $d): ?>
            <tr>
                <td><?= esc($d['gelar_depan'] . ' ' . $d['nama_lengkap'] . ' ' . $d['gelar_belakang']) ?></td>
                <td><?= esc($d['nidn']) ?></td>
                <td>
                    <?php
                        if (isset($jabatan[$d['id_dosen']])) {
                            foreach ($jabatan[$d['id_dosen']] as $j) {
                                echo esc($j['nama_jabatan']) . ' (' . esc($j['tmt_mulai']) . ')<br>';
                            }
                        } else {
                            echo 'Belum ada';
                        }
                    ?>
                </td>
                <td><?= esc($d['email_kampus']) ?></td>
                <td><?= esc($d['no_hp']) ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

</body>
</html>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/jquery.min.js"></script>