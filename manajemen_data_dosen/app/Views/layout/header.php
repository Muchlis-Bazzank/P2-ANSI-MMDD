<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Data Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

    <?php if (session()->get('isLoggedIn')): ?>
    <!-- Sidebar toggle button -->
    <button id="toggleSidebar" class="btn btn-light position-fixed top-0 start-0 m-2 z-3 d-lg-none">
        ☰
    </button>

    <?= view('layout/sidebar') ?>

    <main id="mainContent" class="container-fluid transition" style="margin-left: 250px;">
        <?php else: ?>
        <main class="container mt-4">
            <?php endif; ?>

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="<?= base_url() ?>">Sistem Dosen</a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <?php if (session()->get('isLoggedIn')): ?>
                            <?php if (session()->get('role') === 'admin'): ?>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('admin/dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/dosen') ?>">Kelola
                                    Dosen</a></li>
                            <?php elseif (session()->get('role') === 'dosen'): ?>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('dosen/dashboard') ?>">Dashboard</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('dosen/profil') ?>">Profil
                                    Saya</a></li>
                            <?php endif; ?>
                            <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('/') ?>">Beranda</a></li>
                            <?php endif; ?>
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <?php if (session()->get('isLoggedIn')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><?= session()->get('email') ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?= base_url('auth/register') ?>">Register</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>