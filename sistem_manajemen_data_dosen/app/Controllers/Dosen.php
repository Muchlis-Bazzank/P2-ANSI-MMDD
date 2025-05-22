<?php

namespace App\Controllers;
use App\Models\DosenModel;
use App\Models\JabatanModel;

class Dosen extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenModel();
        $jabatanModel = new JabatanModel();

        $data['dosen'] = $dosenModel->findAll();

        // Ambil semua jabatan dan kelompokkan berdasarkan id_dosen
        $jabatanData = $jabatanModel->findAll();
        $jabatanGrouped = [];

        foreach ($jabatanData as $jab) {
            $jabatanGrouped[$jab['id_dosen']][] = $jab;
        }

        $data['jabatan'] = $jabatanGrouped;

        return view('dosen/index', $data);  
    }

}