<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Dosen</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
    <!-- Navbar -->
    <nav class="main-navbar">
        <a href="<?= base_url('/') ?>" class="navbar-brand">
            <i class="fas fa-university"></i>
            <span>SIAKAD</span>
        </a>
        
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="navbar-menu" id="navbarMenu">
            <a href="<?= base_url('/') ?>" class="navbar-item active">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="<?= base_url('dosen') ?>" class="navbar-item">
                <i class="fas fa-users"></i> Dosen
            </a>
            <a href="<?= base_url('matakuliah') ?>" class="navbar-item">
                <i class="fas fa-book"></i> Mata Kuliah
            </a>
            <a href="<?= base_url('jadwal') ?>" class="navbar-item">
                <i class="fas fa-calendar-alt"></i> Jadwal
            </a>
            <a href="<?= base_url('mahasiswa') ?>" class="navbar-item">
                <i class="fas fa-user-graduate"></i> Mahasiswa
            </a>
        </div>
        
        <div class="navbar-auth">
            <a href="<?= base_url('login') ?>" class="navbar-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
        </div>
    </nav>

    <div class="container mt-5 fade-in">
        <div class="header-container text-center">
            <h2 class="header-title">Daftar Dosen</h2>
            <p class="header-subtitle">Data lengkap tenaga pengajar</p>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari dosen...">
        </div>

        <div class="tab-container">
            <button class="tab-button active" onclick="switchTable(0)">Format Sederhana</button>
            <button class="tab-button" onclick="switchTable(1)">Format Lengkap</button>
        </div>

        <div class="card fade-in" style="animation-delay: 0.2s;">
            <div class="card-header">
                <i class="fas fa-users"></i> Daftar Dosen
            </div>
            <div class="card-body p-0">
                <div id="table1" class="table-container active">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
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
                    </div>
                </div>

                <div id="table2" class="table-container">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
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
                                                        echo '<div class="jabatan-badge">' . esc($j['nama_jabatan']) . '</div> <span class="jabatan-date">(' . esc($j['tmt_mulai']) . ')</span><br>';
                                                    }
                                                } else {
                                                    echo '<span class="text-muted">Belum ada</span>';
                                                }
                                            ?>
                                        </td>
                                        <td><?= esc($d['email_kampus']) ?></td>
                                        <td><?= esc($d['no_hp']) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <p class="footer-text">© <?= date('Y') ?> - Sistem Informasi Dosen</p>
    </div>

    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/script.js"></script>
   
</body>
</html>