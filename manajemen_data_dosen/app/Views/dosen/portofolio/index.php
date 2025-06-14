<?= view('layout/header') ?>

<div class="container">
    <h3>Portofolio Saya</h3>
    <a href="<?= base_url('dosen/portofolio/create') ?>" class="btn btn-success mb-3">+ Tambah Portofolio</a>

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
            <input type="number" name="tahun" class="form-control" value="<?= esc($tahun) ?>" placeholder="Tahun">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($portofolio as $item): ?>
            <tr>
                <td><?= ucfirst($item['kategori']) ?></td>
                <td><?= esc($item['judul']) ?></td>
                <td><?= esc($item['deskripsi']) ?></td>
                <td><?= esc($item['tahun']) ?></td>
                <td>
                    <a href="<?= base_url('dosen/portofolio/edit/' . $item['id']) ?>"
                        class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('dosen/portofolio/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?php if ($portofolio): ?>
    <div class="card mt-4">
        <div class="card-body">
            <canvas id="grafikPortofolio" height="100"></canvas>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('grafikPortofolio').getContext('2d');

    const data = <?= json_encode(array_values(array_reduce($portofolio, function ($carry, $item) {
          $key = $item['tahun'];
          $carry[$key] = ($carry[$key] ?? 0) + 1;
          return $carry;
      }, []))) ?>;

    const labels = <?= json_encode(array_keys(array_reduce($portofolio, function ($carry, $item) {
          $key = $item['tahun'];
          $carry[$key] = ($carry[$key] ?? 0) + 1;
          return $carry;
      }, []))) ?>;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kegiatan',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
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
                        text: 'Jumlah Kegiatan'
                    }
                }
            }
        }
    });
    </script>
    <?php endif ?>
</div>

<?= view('layout/footer') ?>