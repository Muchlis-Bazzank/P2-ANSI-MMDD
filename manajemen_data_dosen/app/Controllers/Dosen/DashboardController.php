<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\KeahlianModel;
use App\Models\JadwalModel;
use App\Models\EvaluasiModel;

class DashboardController extends BaseController
{
    public function index()
    {

        $userId = session('user_id');
        $db = db_connect();

        // Cek profil dosen
        $dosen = $db->table('dosen')->where('user_id', $userId)->get()->getRow();

        if (!$dosen) {
            return redirect()->to('/dosen/lengkapi-profil')->with('warning', 'Lengkapi profil terlebih dahulu.');
        }

        // Ambil data statistik
        $keahlianModel = new KeahlianModel();
        $jadwalModel   = new JadwalModel();
        $evaluasiModel = new EvaluasiModel();

        $data = [
            'totalKeahlian' => $keahlianModel->where('dosen_id', $dosen->id)->countAllResults(),
            'totalJadwal'   => $jadwalModel->where('dosen_id', $dosen->id)->countAllResults(),
            'evaluasi'      => $evaluasiModel->where('dosen_id', $dosen->id)->orderBy('tanggal_evaluasi', 'ASC')->findAll(),
        ];

        return view('dosen/dashboard', $data);
    }
}