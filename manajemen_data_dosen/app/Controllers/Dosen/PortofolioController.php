<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\PortofolioModel;

class PortofolioController extends BaseController
{
    public function index()
    {
        $dosenId = session('dosen_id');
        $model = new PortofolioModel();

        $kategori = $this->request->getGet('kategori');
        $tahun = $this->request->getGet('tahun');

        $query = $model->where('dosen_id', $dosenId);
        if ($kategori) $query->where('kategori', $kategori);
        if ($tahun) $query->where('tahun', $tahun);

        $data['kategori'] = $kategori;
        $data['tahun'] = $tahun;
        $data['portofolio'] = $query->orderBy('tahun', 'DESC')->findAll();

        return view('dosen/portofolio/index', $data);
    }

    public function create()
    {
        return view('dosen/portofolio/form');
    }

    public function store()
    {
        $model = new PortofolioModel();
        $model->insert([
            'dosen_id' => session('dosen_id'),
            'kategori' => $this->request->getPost('kategori'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tahun' => $this->request->getPost('tahun')
        ]);

        return redirect()->to('/dosen/portofolio')->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new PortofolioModel();
        $data['item'] = $model->where('id', $id)->first();

        return view('dosen/portofolio/form_edit', $data);
    }

    public function update($id)
    {
        $model = new PortofolioModel();
        $model->update($id, [
            'kategori' => $this->request->getPost('kategori'),
            'judul' => $this->request->getPost('judul'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'tahun' => $this->request->getPost('tahun')
        ]);

        return redirect()->to('/dosen/portofolio')->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new PortofolioModel();
        $model->delete($id);

        return redirect()->to('/dosen/portofolio')->with('success', 'Portofolio berhasil dihapus.');
    }
}