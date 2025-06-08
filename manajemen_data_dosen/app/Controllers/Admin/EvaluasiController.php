<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\EvaluasiModel;
use App\Models\DosenModel;
use CodeIgniter\HTTP\RedirectResponse;

class EvaluasiController extends BaseController
{
    public function index()
    {
        $db = db_connect();

        $evaluasi = $db->table('evaluasi')
            ->select('evaluasi.*, users.nama')
            ->join('dosen', 'dosen.id = evaluasi.dosen_id')
            ->join('users', 'users.id = dosen.user_id')
            ->orderBy('tanggal_evaluasi', 'DESC')
            ->get()->getResultArray();

        return view('admin/evaluasi/list', ['evaluasi' => $evaluasi]);
    }

    public function create()
    {
        $dosenModel = new DosenModel();

        $daftarDosen = $dosenModel
            ->select('dosen.id as dosen_id, users.nama')
            ->join('users', 'users.id = dosen.user_id')
            ->findAll();

        return view('admin/evaluasi/form', ['daftarDosen' => $daftarDosen]);
    }

    public function store(): RedirectResponse
    {
        $model = new EvaluasiModel();
        $model->insert([
            'dosen_id' => $this->request->getPost('dosen_id'),
            'tanggal_evaluasi' => $this->request->getPost('tanggal_evaluasi'),
            'skor' => $this->request->getPost('skor'),
        ]);

        return redirect()->to('/admin/evaluasi')->with('success', 'Evaluasi ditambahkan.');
    }

    public function edit($id)
{
    $model = new EvaluasiModel();
    $evaluasi = $model->find($id);

    $dosenModel = new DosenModel();
    $daftarDosen = $dosenModel
        ->select('dosen.id as dosen_id, users.nama')
        ->join('users', 'users.id = dosen.user_id')
        ->findAll();

    return view('admin/evaluasi/form', [
        'evaluasi' => $evaluasi,
        'daftarDosen' => $daftarDosen,
        'edit' => true
    ]);
}

public function update($id)
{
    $model = new EvaluasiModel();
    $model->update($id, [
        'dosen_id' => $this->request->getPost('dosen_id'),
        'tanggal_evaluasi' => $this->request->getPost('tanggal_evaluasi'),
        'skor' => $this->request->getPost('skor'),
    ]);

    return redirect()->to('/admin/evaluasi')->with('success', 'Evaluasi diperbarui.');
}

public function delete($id)
{
    $model = new EvaluasiModel();
    $model->delete($id);
    return redirect()->to('/admin/evaluasi')->with('success', 'Evaluasi dihapus.');
}

    public function grafik()
    {
        $db = db_connect();

        $evaluasi = $db->table('evaluasi')
            ->select('tanggal_evaluasi, AVG(skor) as rata_rata')
            ->groupBy('tanggal_evaluasi')
            ->orderBy('tanggal_evaluasi', 'ASC')
            ->get()->getResultArray();

        return view('admin/evaluasi/grafik', ['evaluasi' => $evaluasi]);
    }
    
}