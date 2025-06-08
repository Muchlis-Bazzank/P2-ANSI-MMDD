<?= view('layout/header') ?>

<div class="container mt-5">
    <h2>Dashboard Dosen</h2>
    <p>Selamat datang, <?= session('email') ?>.</p>
    <a href="<?= base_url('dosen/profil') ?>" class="btn btn-primary">Lihat Profil Saya</a>
</div>

<div class="container mt-4">
    <h4>Statistik Dosen</h4>

    <div class="row text-center my-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Bidang Keahlian Saya</h5>
                    <h3><?= $totalKeahlian ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Jadwal Mengajar Saya</h5>
                    <h3><?= $totalJadwal ?></h3>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h4 class="mt-5">Riwayat Evaluasi Kinerja</h4>

    <?php if (empty($evaluasi)): ?>
    <div class="alert alert-info">Belum ada evaluasi kinerja.</div>
    <?php else: ?>
    <canvas id="grafikEvaluasi" height="100"></canvas>
    <?php endif; ?>
</div>

<?php if (!empty($evaluasi)): ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('grafikEvaluasi').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode(array_map(fn($e) => $e['semester'] . ' ' . $e['tahun_ajaran'], $evaluasi)) ?>,
        datasets: [{
            label: 'Skor Evaluasi',
            data: <?= json_encode(array_column($evaluasi, 'skor')) ?>,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.3,
            fill: false
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                suggestedMax: 100
            }
        }
    }
});
</script>
<?php endif; ?>

<?= view('layout/footer') ?>