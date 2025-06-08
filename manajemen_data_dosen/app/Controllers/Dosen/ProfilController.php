<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\KeahlianModel;
use App\Models\JadwalModel;
use App\Models\EvaluasiModel;

class ProfilController extends BaseController
{
    public function index()
{
    $userId = session()->get('user_id');
    $db = db_connect();

    // Ambil profil dosen + user
    $profil = $db->table('dosen')
        ->select('dosen.*, users.nama, users.email')
        ->join('users', 'users.id = dosen.user_id')
        ->where('dosen.user_id', $userId)
        ->get()
        ->getRowArray();

    if (!$profil) {
        return redirect()->to('/dosen/dashboard')->with('error', 'Data dosen tidak ditemukan.');
    }

    // Ambil keahlian dan jadwal
    $keahlianModel = new KeahlianModel();
    $jadwalModel   = new JadwalModel();
    $evaluasiModel = new EvaluasiModel();

    $keahlian = $keahlianModel->where('dosen_id', $profil['id'])->findAll();
    $jadwal   = $jadwalModel->where('dosen_id', $profil['id'])->findAll();

    // ✅ Tambahkan ambil data evaluasi
    $evaluasi = $evaluasiModel
        ->where('dosen_id', $profil['id'])
        ->orderBy('tanggal_evaluasi', 'ASC')
        ->findAll();

    // Kirim semua data ke view
    $data = [
        'profil'   => $profil,
        'keahlian' => $keahlian,
        'jadwal'   => $jadwal,
        'evaluasi' => $evaluasi, // ← ini yang digunakan oleh grafik Chart.js
    ];

    return view('dosen/profil', $data);
}


    public function edit()
{
    $userId = session()->get('user_id');
    $db = db_connect();
    $profil = $db->table('dosen')
        ->select('dosen.*, users.nama, users.email')
        ->join('users', 'users.id = dosen.user_id')
        ->where('user_id', $userId)
        ->get()->getRowArray();

    return view('dosen/edit_profil', ['profil' => $profil]);
}

public function update()
{
    $db = db_connect();
    $userId = session()->get('user_id');

    // Update users
    $db->table('users')->where('id', $userId)->update([
        'nama'  => $this->request->getPost('nama'),
        'email' => $this->request->getPost('email'),
    ]);

    // Ambil ID dosen
    $dosen = $db->table('dosen')->where('user_id', $userId)->get()->getRow();

    $dataUpdate = [
        'nidn'     => $this->request->getPost('nidn'),
        'nip'      => $this->request->getPost('nip'),
        'gelar'    => $this->request->getPost('gelar'),
        'alamat'   => $this->request->getPost('alamat'),
        'telepon'  => $this->request->getPost('telepon'),
    ];

    // Cek apakah ada file foto
    $foto = $this->request->getFile('foto');
    if ($foto && $foto->isValid() && !$foto->hasMoved()) {
        $namaFoto = $foto->getRandomName();
        $foto->move('uploads/', $namaFoto);
        $dataUpdate['foto'] = $namaFoto;
    }

    $db->table('dosen')->where('id', $dosen->id)->update($dataUpdate);

    return redirect()->to('/dosen/profil')->with('success', 'Profil berhasil diperbarui.');
}


public function tambahKeahlian()
{
    $keahlianModel = new KeahlianModel();
    $userId = session()->get('user_id');
    $dosenId = db_connect()->table('dosen')->select('id')->where('user_id', $userId)->get()->getRow('id');

    $keahlianModel->insert([
        'dosen_id' => $dosenId,
        'nama_keahlian' => $this->request->getPost('nama_keahlian')
    ]);

    return redirect()->to('/dosen/profil')->with('success', 'Bidang keahlian ditambahkan.');
}

public function hapusKeahlian($id)
{
    $model = new KeahlianModel();
    $model->delete($id);
    return redirect()->to('/dosen/profil')->with('success', 'Keahlian dihapus.');
}

public function editKeahlian($id)
{
    $model = new KeahlianModel();
    $data['keahlian'] = $model->find($id);
    return view('dosen/edit_keahlian', $data);
}

public function updateKeahlian($id)
{
    $model = new KeahlianModel();
    $model->update($id, ['nama_keahlian' => $this->request->getPost('nama_keahlian')]);
    return redirect()->to('/dosen/profil')->with('success', 'Keahlian diperbarui.');
}


public function tambahJadwal()
{
    $jadwalModel = new JadwalModel();
    $userId = session()->get('user_id');
    $dosenId = db_connect()->table('dosen')->select('id')->where('user_id', $userId)->get()->getRow('id');

    $jadwalModel->insert([
        'dosen_id'     => $dosenId,
        'mata_kuliah'  => $this->request->getPost('mata_kuliah'),
        'hari'         => $this->request->getPost('hari'),
        'jam_mulai'    => $this->request->getPost('jam_mulai'),
        'jam_selesai'  => $this->request->getPost('jam_selesai'),
        'ruang'        => $this->request->getPost('ruang')
    ]);

    return redirect()->to('/dosen/profil')->with('success', 'Jadwal mengajar ditambahkan.');
}

public function hapusJadwal($id)
{
    $model = new JadwalModel();
    $model->delete($id);
    return redirect()->to('/dosen/profil')->with('success', 'Jadwal dihapus.');
}

public function editJadwal($id)
{
    $model = new JadwalModel();
    $data['jadwal'] = $model->find($id);
    return view('dosen/edit_jadwal', $data);
}

public function updateJadwal($id)
{
    $model = new JadwalModel();
    $model->update($id, $this->request->getPost());
    return redirect()->to('/dosen/profil')->with('success', 'Jadwal diperbarui.');
}


}