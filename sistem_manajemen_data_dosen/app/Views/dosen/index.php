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
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #f5f6fa;
            --dark-color: #2c3e50;
            --border-radius: 6px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --navbar-height: 70px;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            padding-bottom: 50px;
            padding-top: var(--navbar-height);
        }

        /* Navbar Styles */
        .main-navbar {
            background-color: white;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--navbar-height);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-menu {
            display: flex;
            margin-left: 40px;
            flex-grow: 1;
        }

        .navbar-item {
            margin-right: 25px;
            font-weight: 500;
            color: #555;
            text-decoration: none;
            font-size: 0.95rem;
            position: relative;
            transition: color 0.3s;
        }

        .navbar-item:hover {
            color: var(--secondary-color);
        }

        .navbar-item.active {
            color: var(--secondary-color);
        }

        .navbar-item.active:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--secondary-color);
            border-radius: 3px;
        }

        .navbar-auth {
            display: flex;
            align-items: center;
        }

        .btn-login {
            background-color: var(--primary-color);
            color: white;
            padding: 8px 20px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark-color);
            cursor: pointer;
        }

        @media (max-width: 992px) {
            .navbar-menu {
                position: fixed;
                top: var(--navbar-height);
                left: -100%;
                width: 250px;
                height: calc(100vh - var(--navbar-height));
                background-color: white;
                flex-direction: column;
                padding: 20px;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
                transition: left 0.3s;
                margin-left: 0;
            }

            .navbar-menu.active {
                left: 0;
            }

            .navbar-item {
                margin: 15px 0;
                font-size: 1.1rem;
            }

            .mobile-menu-btn {
                display: block;
                margin-left: auto;
                margin-right: 15px;
            }
        }

        .header-container {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }

        .header-title {
            margin: 0;
            padding: 0 15px;
            font-weight: 600;
            font-size: 2.2rem;
        }

        .header-subtitle {
            opacity: 0.8;
            margin: 10px 0 0;
            padding: 0 15px;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            border: none;
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-top: none;
            border-bottom: 2px solid var(--secondary-color);
            color: var(--dark-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle;
            padding: 0.75rem;
        }

        .search-container {
            margin-bottom: 20px;
        }

        .search-input {
            border-radius: 50px;
            padding: 10px 20px;
            border: 1px solid #ced4da;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            width: 100%;
        }

        .tab-container {
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            background-color: #f8f9fa;
            border: none;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            color: #6c757d;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
        }

        .tab-button.active {
            background-color: var(--secondary-color);
            color: white;
        }

        .table-container {
            display: none;
        }

        .table-container.active {
            display: block;
        }

        .jabatan-badge {
            display: inline-block;
            padding: 4px 8px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50px;
            font-size: 0.85rem;
            margin-bottom: 4px;
            white-space: nowrap;
        }

        .jabatan-date {
            color: #6c757d;
            font-size: 0.8rem;
            font-style: italic;
        }

        .footer-text {
            text-align: center;
            padding: 20px 0;
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .header-title {
                font-size: 1.8rem;
            }

            .table-responsive {
                border: none;
            }
        }

        /* Animation for loading effect */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
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
            <button class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
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
    <script>
        // Function to switch between tables
        function switchTable(tableIndex) {
            const tables = document.querySelectorAll('.table-container');
            const buttons = document.querySelectorAll('.tab-button');
            
            tables.forEach((table, index) => {
                if (index === tableIndex) {
                    table.classList.add('active');
                } else {
                    table.classList.remove('active');
                }
            });
            
            buttons.forEach((button, index) => {
                if (index === tableIndex) {
                    button.classList.add('active');
                } else {
                    button.classList.remove('active');
                }
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const tables = document.querySelectorAll('.table');
            
            tables.forEach(table => {
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Add animation class when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            document.getElementById('navbarMenu').classList.toggle('active');
        });

        // Login button modal (placeholder)
        document.querySelector('.btn-login').addEventListener('click', function() {
            alert('Fitur login akan segera tersedia!');
            // Implement your login modal here
        });
    </script>
</body>
</html>