<?= view('layout/header') ?>

<div class="container mt-5">
    <h2>Dashboard Admin</h2>
    <p>Selamat datang, Admin. Anda memiliki akses penuh untuk mengelola data dosen.</p>
    <a href="<?= base_url('admin/dosen') ?>" class="btn btn-primary">Kelola Dosen</a>
</div>

<div class="container mt-4">
    <h4>Statistik Dosen</h4>
    <div class="row text-center my-4">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Total Dosen</h5>
                    <h3><?= $totalDosen ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Bidang Keahlian</h5>
                    <h3><?= $totalKeahlian ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5>Jadwal Mengajar</h5>
                    <h3><?= $totalJadwal ?></h3>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <h4 class="mt-5">Distribusi Jadwal Mengajar per Hari</h4>
    <canvas id="grafikHari" height="100"></canvas>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('grafikHari').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($grafikHari, 'hari')) ?>,
        datasets: [{
            label: 'Jumlah Jadwal',
            data: <?= json_encode(array_column($grafikHari, 'jumlah')) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<?= view('layout/footer') ?>