<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\KeahlianModel;
use App\Models\JadwalModel;

class DashboardController extends BaseController
{
    public function index()
    {

        if (!session()->get('isLoggedIn') || session()->get('user_role') !== 'admin') {
        return redirect()->to('/auth/login')->with('error', 'Silakan login sebagai admin.');
    }

        $dosenModel = new DosenModel();
        $keahlianModel = new KeahlianModel();
        $jadwalModel = new JadwalModel();

        $data = [
            'totalDosen'     => $dosenModel->countAll(),
            'totalKeahlian'  => $keahlianModel->countAll(),
            'totalJadwal'    => $jadwalModel->countAll(),
        ];

        // Optional: Untuk grafik distribusi dosen per hari mengajar
        $grafik = $jadwalModel
                    ->select("hari, COUNT(*) as jumlah")
                    ->groupBy('hari')
                    ->findAll();

        $data['grafikHari'] = $grafik;

        return view('admin/dashboard', $data);
    }
}