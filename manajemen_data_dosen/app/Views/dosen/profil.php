<?= view('layout/header') ?>

<div class="container mt-4">
    <?php if (!empty($profil['foto'])): ?>
    <img src="<?= base_url('uploads/' . $profil['foto']) ?>" width="150" class="mb-3 rounded-circle">
    <?php endif; ?>

    <h2>Profil Dosen</h2>
    <a href="<?= base_url('dosen/profil/edit') ?>" class="btn btn-primary mb-3">Edit Profil Saya</a>
    <p>Selamat datang, <?= esc($profil['nama']) ?>.</p>
    <p>NIDN: <?= esc($profil['nidn']) ?></p>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-start border-primary border-4">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Bidang Keahlian</h6>
                    <h3><?= isset($keahlian) ? count($keahlian) : 0 ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-start border-success border-4">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Jadwal Mengajar</h6>
                    <h3><?= isset($jadwal) ? count($jadwal) : 0 ?></h3>
                </div>
            </div>
        </div>
    </div>


    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?= esc($profil['nama']) ?></h5>
            <p>Email: <?= esc($profil['email']) ?></p>
            <p>NIDN: <?= esc($profil['nidn']) ?></p>
            <p>NIP: <?= esc($profil['nip']) ?></p>
            <p>Gelar: <?= esc($profil['gelar']) ?></p>
            <p>Alamat: <?= esc($profil['alamat']) ?></p>
            <p>Telepon: <?= esc($profil['telepon']) ?></p>
        </div>
    </div>

    <h4>Bidang Keahlian</h4>
    <?php if (empty($keahlian)): ?>
    <p class="text-muted">Belum ada bidang keahlian.</p>
    <?php else: ?>
    <ul class="list-group mb-4">
        <?php foreach ($keahlian as $item): ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?= esc($item['nama_keahlian']) ?>
            <span>
                <a href="<?= base_url('dosen/profil/keahlian/edit/' . $item['id']) ?>"
                    class="btn btn-sm btn-warning">Edit</a>
                <a href="<?= base_url('dosen/profil/keahlian/hapus/' . $item['id']) ?>" class="btn btn-sm btn-danger"
                    onclick="return confirm('Yakin hapus?')">Hapus</a>
            </span>
        </li>
        <?php endforeach ?>
    </ul>
    <?php endif; ?>

    <h5>Tambah Bidang Keahlian</h5>
    <form action="<?= base_url('dosen/profil/keahlian/tambah') ?>" method="post" class="mb-4">
        <?= csrf_field() ?>
        <div class="input-group">
            <input type="text" name="nama_keahlian" class="form-control" placeholder="Contoh: Sistem Informasi"
                required>
            <button class="btn btn-success" type="submit">Tambah Keahlian</button>
        </div>
    </form>

    <h4>Jadwal Mengajar</h4>
    <?php if (empty($jadwal)): ?>
    <p class="text-muted">Belum ada jadwal mengajar.</p>
    <?php else: ?>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Mata Kuliah</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Ruang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jadwal as $j): ?>
            <tr>
                <td><?= esc($j['mata_kuliah']) ?></td>
                <td><?= esc($j['hari']) ?></td>
                <td><?= esc($j['jam_mulai']) ?> - <?= esc($j['jam_selesai']) ?></td>
                <td><?= esc($j['ruang']) ?></td>
                <td>
                    <a href="<?= base_url('dosen/profil/jadwal/edit/' . $j['id']) ?>"
                        class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('dosen/profil/jadwal/hapus/' . $j['id']) ?>" class="btn btn-sm btn-danger"
                        onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif; ?>

    <h5>Tambah Jadwal Mengajar</h5>
    <form action="<?= base_url('dosen/profil/jadwal/tambah') ?>" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-4 mb-2">
                <input type="text" name="mata_kuliah" class="form-control" placeholder="Mata Kuliah" required>
            </div>
            <div class="col-md-2 mb-2">
                <select name="hari" class="form-control" required>
                    <option value="">Hari</option>
                    <?php foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $h): ?>
                    <option value="<?= $h ?>"><?= $h ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <input type="time" name="jam_mulai" class="form-control" required>
            </div>
            <div class="col-md-2 mb-2">
                <input type="time" name="jam_selesai" class="form-control" required>
            </div>
            <div class="col-md-2 mb-2">
                <input type="text" name="ruang" class="form-control" placeholder="Ruang" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Tambah Jadwal</button>
    </form>

    <h4>Grafik Evaluasi Kinerja</h4>

    <?php if (empty($evaluasi)): ?>
    <p class="text-muted">Belum ada data evaluasi.</p>
    <?php else: ?>
    <canvas id="grafikEvaluasi" height="100"></canvas>
    <?php endif; ?>

</div>

<?= view('layout/footer') ?>