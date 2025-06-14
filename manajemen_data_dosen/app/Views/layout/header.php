<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    html,
    body {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .sidebar {
        width: 250px;
        background-color: #343a40;
        color: white;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        overflow-y: auto;
        z-index: 1050;
        transform: translateX(0);
        transition: transform 0.3s ease;
    }

    .sidebar.collapsed {
        transform: translateX(-100%);
    }

    .sidebar a {
        color: #ccc;
        padding: 12px 16px;
        display: block;
        text-decoration: none;
    }

    .sidebar a:hover {
        background-color: #495057;
    }

    .main-content {
        margin-left: 250px;
        padding: 24px;
        transition: margin-left 0.3s ease;
    }

    .main-content.collapsed {
        margin-left: 0;
    }

    body.dark-mode {
        background-color: #1e1e2f;
        color: #ddd;
    }

    body.dark-mode .navbar,
    body.dark-mode .sidebar {
        background-color: #222;
    }

    body.dark-mode .card {
        background-color: #2c2c3c;
        color: #ddd;
    }

    body.dark-mode .table {
        color: #eee;
    }

    @media (max-width: 991.98px) {
        .main-content {
            margin-left: 0;
        }

        .main-content.shifted {
            margin-left: 250px;
        }
    }
    </style>
</head>

<body>

    <?php if (session()->get('isLoggedIn')): ?>
    <!-- Tombol toggle sidebar -->
    <button id="toggleSidebar" class="btn btn-light position-fixed top-0 start-0 m-2 z-3 d-lg-none">
        ☰
    </button>

    <?= view('layout/sidebar') ?>

    <main id="mainContent" class="main-content">
        <?php else: ?>
        <main class="container mt-4">
            <?php endif; ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= base_url() ?>">Sistem Dosen</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <?php if (session()->get('isLoggedIn')): ?>
                            <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dosen') ?>">Kelola
                                    Dosen</a></li>
                            <?php elseif (session()->get('role') === 'dosen'): ?>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('dosen/dashboard') ?>">Dashboard</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('dosen/profil') ?>">Profil
                                    Saya</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('dosen/portofolio') ?>">Portofolio</a></li>
                            <?php endif; ?>
                            <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Beranda</a></li>
                            <?php endif; ?>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <?php if (session()->get('isLoggedIn')): ?>
                            <li class="nav-item"><span class="nav-link"><?= esc(session('email')) ?></span></li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('auth/register') ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>

                        <?php if (session()->get('isLoggedIn')): ?>
                        <button class="btn btn-sm btn-outline-light ms-2" id="toggleTheme">🌓</button>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>