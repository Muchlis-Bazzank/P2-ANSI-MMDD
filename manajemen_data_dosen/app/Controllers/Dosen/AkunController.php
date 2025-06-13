<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AkunController extends BaseController
{
    public function formPassword()
    {
        return view('dosen/ubah_password');
    }

    public function updatePassword()
{
    $userId = session('user_id');
    $userModel = new UserModel();

    // Ambil user sebagai array
    $user = $userModel->find($userId);

    if (! $user) {
        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }

    $oldPassword = $this->request->getPost('password_lama');
    $newPassword = $this->request->getPost('password_baru');
    $confirmPassword = $this->request->getPost('konfirmasi_password');

    if (!password_verify($oldPassword, $user['password'])) {
        return redirect()->back()->with('error', 'Password lama tidak sesuai.');
    }

    if ($newPassword !== $confirmPassword) {
        return redirect()->back()->with('error', 'Konfirmasi password tidak cocok.');
    }

    if (strlen($newPassword) < 6) {
        return redirect()->back()->with('error', 'Password minimal 6 karakter.');
    }

    $userModel->update($userId, [
        'password' => password_hash($newPassword, PASSWORD_DEFAULT)
    ]);

    return redirect()->to('/dosen/profil')->with('success', 'Password berhasil diubah.');
}


}