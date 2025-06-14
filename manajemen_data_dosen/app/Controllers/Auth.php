<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    
     // ✅ Menampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // ✅ Proses login setelah user mengisi form login
    public function attempt_login()
{
    $session = session();
    $model = new UserModel();

    $email = $this->request->getPost('email');
    $password = $this->request->getPost('password');

    $user = $model->where('email', $email)->first();

    if ($user && password_verify($password, $user['password'])) {
        $sessionData = [
            'user_id'    => $user['id'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'nama'       => $user['nama'],
            'isLoggedIn' => true
        ];

        // ✅ Tambahkan dosen_id jika role = dosen
        if ($user['role'] === 'dosen') {
            $dosen = (new \App\Models\DosenModel())->where('user_id', $user['id'])->first();
            $sessionData['dosen_id'] = $dosen['id'] ?? null;
        }

        $session->set($sessionData);

        // Redirect sesuai role
        return match ($user['role']) {
            'admin' => redirect()->to('/admin/dashboard'),
            'dosen' => redirect()->to('/dosen/dashboard'),
            default => redirect()->to('/')
        };
    }

    return redirect()->back()->with('error', 'Email atau password salah.');
}

    public function register()
    {
        return view('auth/register');
    }

    public function store()
    {
        helper(['form']);

        $rules = [
            'nama'     => 'required|min_length[3]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama'     => $this->request->getPost('nama'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'dosen'
        ]);

        return redirect()->to('/auth/login')->with('success', 'Registrasi berhasil.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Berhasil logout.');
    }
}