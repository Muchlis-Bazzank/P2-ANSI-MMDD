<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class LengkapiProfilController extends BaseController
{
    public function form()
    {
        return view('dosen/lengkapi_profil');
    }

    public function simpan()
    {
        $model = new DosenModel();
        $model->insert([
            'user_id' => session('user_id'),
            'nidn'    => $this->request->getPost('nidn'),
            'nip'     => $this->request->getPost('nip'),
            'gelar'   => $this->request->getPost('gelar'),
            'alamat'  => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/dosen/dashboard')->with('success', 'Profil berhasil dilengkapi.');

        if (!$this->validate([
    'nidn' => 'required',
    'alamat' => 'required',
    'telepon' => 'required'
])) {
    return redirect()->back()->withInput()->with('warning', 'Semua field wajib diisi.');
}
    }
}