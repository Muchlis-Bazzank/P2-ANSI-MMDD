<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\UserModel;

class DosenController extends BaseController
{
    public function index()
    {
        $model = new DosenModel();
        $data['daftarDosen'] = $model->select('dosen.*, users.nama, users.email')
            ->join('users', 'users.id = dosen.user_id')
            ->findAll();
        return view('admin/dosen/list', $data);
    }

    public function create()
    {
        return view('admin/dosen/form');
    }

    public function store()
    {
        $userModel = new UserModel();
        $dosenModel = new DosenModel();

        $userId = $userModel->insert([
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'dosen',
        ]);

        $dosenModel->insert([
            'user_id' => $userId,
            'nidn' => $this->request->getPost('nidn'),
            'nip' => $this->request->getPost('nip'),
            'gelar' => $this->request->getPost('gelar'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/admin/dosen')->with('success', 'Dosen ditambahkan.');
    }

    public function edit($id)
    {
        $model = new DosenModel();
        $dosen = $model->select('dosen.*, users.nama, users.email')
            ->join('users', 'users.id = dosen.user_id')
            ->where('dosen.id', $id)->first();

        return view('admin/dosen/form', ['dosen' => $dosen, 'edit' => true]);
    }

    public function update($id)
    {
        $dosenModel = new DosenModel();
        $userModel  = new UserModel();

        $dosen = $dosenModel->find($id);

        $userModel->update($dosen['user_id'], [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ]);

        $dosenModel->update($id, [
            'nidn' => $this->request->getPost('nidn'),
            'nip' => $this->request->getPost('nip'),
            'gelar' => $this->request->getPost('gelar'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ]);

        return redirect()->to('/admin/dosen')->with('success', 'Dosen diperbarui.');
    }

    public function delete($id)
    {
        $dosenModel = new DosenModel();
        $userModel  = new UserModel();

        $dosen = $dosenModel->find($id);
        if ($dosen) {
            $userModel->delete($dosen['user_id']);
            $dosenModel->delete($id);
        }

        return redirect()->to('/admin/dosen')->with('success', 'Dosen dihapus.');
    }

    public function resetPasswordForm($id)
{
    $dosen = (new DosenModel())
        ->select('dosen.*, users.email, users.nama')
        ->join('users', 'users.id = dosen.user_id')
        ->where('dosen.id', $id)
        ->first();

    return view('admin/dosen/reset_password', ['dosen' => $dosen]);
}

public function resetPassword($id)
{
    $userModel = new UserModel();
    $dosen = (new DosenModel())->find($id);
    $newPassword = $this->request->getPost('password');

    $userModel->update($dosen['user_id'], [
        'password' => password_hash($newPassword, PASSWORD_DEFAULT)
    ]);

    return redirect()->to('/admin/dosen')->with('success', 'Password berhasil direset.');
}

}