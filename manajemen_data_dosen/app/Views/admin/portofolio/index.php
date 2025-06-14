<?= view('layout/header') ?>

<div class="container">
    <h3>Portofolio Seluruh Dosen</h3>

    <!-- Filter -->
    <form method="get" class="row mb-3">
        <div class="col-md-3">
            <select name="kategori" class="form-select">
                <option value="">Semua Kategori</option>
                <option value="pengajaran" <?= ($kategori == 'pengajaran') ? 'selected' : '' ?>>Pengajaran</option>
                <option value="penelitian" <?= ($kategori == 'penelitian') ? 'selected' : '' ?>>Penelitian</option>
                <option value="pengabdian" <?= ($kategori == 'pengabdian') ? 'selected' : '' ?>>Pengabdian</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="tahun" class="form-control" placeholder="Tahun" value="<?= esc($tahun) ?>">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </form>

    <!-- Tabel -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Dosen</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($portofolio as $p): ?>
            <tr>
                <td><?= esc($p['nama_dosen']) ?></td>
                <td><?= ucfirst($p['kategori']) ?></td>
                <td><?= esc($p['judul']) ?></td>
                <td><?= esc($p['tahun']) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- Grafik -->
    <?php if ($portofolio): ?>
    <div class="card mt-4">
        <div class="card-body">
            <canvas id="grafikPortofolio" height="100"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('grafikPortofolio').getContext('2d');

    const dataMap = <?= json_encode(array_reduce($portofolio, function ($carry, $item) {
          $key = $item['tahun'];
          $carry[$key] = ($carry[$key] ?? 0) + 1;
          return $carry;
      }, [])) ?>;

    const labels = Object.keys(dataMap);
    const data = Object.values(dataMap);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kegiatan',
                data: data,
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    }
                }
            }
        }
    });
    </script>
    <?php endif; ?>
</div>

<?= view('layout/footer') ?>