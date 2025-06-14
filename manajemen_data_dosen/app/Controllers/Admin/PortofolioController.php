<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PortofolioModel;
use App\Models\DosenModel;
use App\Models\UserModel;

class PortofolioController extends BaseController
{
    public function index()
    {
        $model = new PortofolioModel();
        $kategori = $this->request->getGet('kategori');
        $tahun = $this->request->getGet('tahun');

        $query = $model->select('portofolio.*, users.nama AS nama_dosen')
            ->join('dosen', 'dosen.id = portofolio.dosen_id')
            ->join('users', 'users.id = dosen.user_id');

        if ($kategori) $query->where('kategori', $kategori);
        if ($tahun) $query->where('tahun', $tahun);

        $data['portofolio'] = $query->orderBy('tahun', 'DESC')->findAll();
        $data['kategori'] = $kategori;
        $data['tahun'] = $tahun;

        return view('admin/portofolio/index', $data);
    }
}