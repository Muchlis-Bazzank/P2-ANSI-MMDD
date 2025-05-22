<?php
// File: app/Controllers/Auth.php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LogAktivitasModel;
use App\Models\StatistikAksesModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $logModel;
    protected $statistikModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->logModel = new LogAktivitasModel();
        $this->statistikModel = new StatistikAksesModel();
    }

    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('logged_in')) {
            return $this->redirectToDashboard();
        }

        return view('auth/login');
    }

    public function login()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[6]'
        ], [
            'username' => [
                'required' => 'Username harus diisi',
                'min_length' => 'Username minimal 3 karakter'
            ],
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Password minimal 6 karakter'
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return view('auth/login', [
                'validation' => $validation,
                'old_input' => $this->request->getPost()
            ]);
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Login berhasil
            $sessionData = [
                'user_id' => $user['id_user'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true
            ];
            
            session()->set($sessionData);

            // Update last login
            $this->userModel->update($user['id_user'], [
                'last_login' => date('Y-m-d H:i:s')
            ]);

            // Log aktivitas
            $this->logModel->insert([
                'id_user' => $user['id_user'],
                'aktivitas' => 'Login',
                'keterangan' => 'User berhasil login ke sistem',
                'timestamp' => date('Y-m-d H:i:s')
            ]);

            // Log statistik akses
            $this->statistikModel->insert([
                'id_user' => $user['id_user'],
                'jenis_akses' => 'Login',
                'waktu_akses' => date('Y-m-d H:i:s'),
                'ip_address' => $this->request->getIPAddress()
            ]);

            return $this->redirectToDashboard();
        } else {
            return view('auth/login', [
                'error' => 'Username atau password salah!',
                'old_input' => $this->request->getPost()
            ]);
        }
    }

    public function logout()
    {
        $userId = session()->get('user_id');
        
        if ($userId) {
            // Log aktivitas logout
            $this->logModel->insert([
                'id_user' => $userId,
                'aktivitas' => 'Logout',
                'keterangan' => 'User logout dari sistem',
                'timestamp' => date('Y-m-d H:i:s')
            ]);

            // Log statistik akses
            $this->statistikModel->insert([
                'id_user' => $userId,
                'jenis_akses' => 'Logout',
                'waktu_akses' => date('Y-m-d H:i:s'),
                'ip_address' => $this->request->getIPAddress()
            ]);
        }

        session()->destroy();
        return redirect()->to('/auth')->with('success', 'Anda berhasil logout');
    }

    private function redirectToDashboard()
    {
        $role = session()->get('role');
        
        if ($role === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/dosen/dashboard');
        }
    }
}

// ========================================================================
// File: app/Models/UserModel.php
<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'username', 'password_hash', 'email', 'role', 'last_login', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id_user,{id_user}]',
        'password_hash' => 'required',
        'email' => 'permit_empty|valid_email|is_unique[users.email,id_user,{id_user}]',
        'role' => 'required|in_list[admin,dosen]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'max_length' => 'Username maksimal 50 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'email' => [
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah digunakan'
        ],
        'role' => [
            'required' => 'Role harus dipilih',
            'in_list' => 'Role tidak valid'
        ]
    ];

    public function getUserWithDosen($userId)
    {
        return $this->select('users.*, dosen.nama_lengkap, dosen.nidn')
                   ->join('dosen', 'dosen.id_user = users.id_user', 'left')
                   ->where('users.id_user', $userId)
                   ->first();
    }
}

// ========================================================================
// File: app/Models/LogAktivitasModel.php
<?php
namespace App\Models;

use CodeIgniter\Model;

class LogAktivitasModel extends Model
{
    protected $table = 'log_aktivitas';
    protected $primaryKey = 'id_log';
    protected $allowedFields = [
        'id_user', 'aktivitas', 'keterangan', 'timestamp'
    ];

    public function getLogByUser($userId, $limit = 10)
    {
        return $this->where('id_user', $userId)
                   ->orderBy('timestamp', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    public function getLogWithUser($limit = 50)
    {
        return $this->select('log_aktivitas.*, users.username')
                   ->join('users', 'users.id_user = log_aktivitas.id_user')
                   ->orderBy('timestamp', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }
}

// ========================================================================
// File: app/Models/StatistikAksesModel.php
<?php
namespace App\Models;

use CodeIgniter\Model;

class StatistikAksesModel extends Model
{
    protected $table = 'statistik_akses';
    protected $primaryKey = 'id_statistik';
    protected $allowedFields = [
        'id_user', 'jenis_akses', 'waktu_akses', 'ip_address'
    ];

    public function getStatistikByUser($userId, $limit = 10)
    {
        return $this->where('id_user', $userId)
                   ->orderBy('waktu_akses', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    public function getStatistikWithUser($limit = 50)
    {
        return $this->select('statistik_akses.*, users.username')
                   ->join('users', 'users.id_user = statistik_akses.id_user')
                   ->orderBy('waktu_akses', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }
}

// ========================================================================
// File: app/Views/auth/login.php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Manajemen Data Dosen</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group input.is-invalid {
            border-color: #dc3545;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .role-info {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e1e5e9;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Login</h1>
            <p>Sistem Manajemen Data Dosen</p>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?= esc($error) ?>
            </div>
        <?php endif; ?>

        <?= form_open('auth/login') ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" 
                       id="username" 
                       name="username" 
                       value="<?= isset($old_input['username']) ? esc($old_input['username']) : '' ?>"
                       class="<?= isset($validation) && $validation->hasError('username') ? 'is-invalid' : '' ?>">
                <?php if (isset($validation) && $validation->hasError('username')): ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('username') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       id="password" 
                       name="password"
                       class="<?= isset($validation) && $validation->hasError('password') ? 'is-invalid' : '' ?>">
                <?php if (isset($validation) && $validation->hasError('password')): ?>
                    <div class="invalid-feedback">
                        <?= $validation->getError('password') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="#" class="forgot-password">Lupa password?</a>
            </div>

            <button type="submit" class="login-btn">Masuk</button>
        <?= form_close() ?>

        <div class="role-info">
            <p>Login sebagai <strong>Admin</strong> atau <strong>Dosen</strong></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('username').focus();
        });
    </script>
</body>
</html>

// ========================================================================
// File: app/Config/Routes.php (tambahkan ini)
/*
$routes->group('auth', function($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
});
*/

// ========================================================================
// File: app/Filters/AuthFilter.php
<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/auth')->with('error', 'Silakan login terlebih dahulu');
        }

        // Check role if specified
        if ($arguments) {
            $userRole = session()->get('role');
            if (!in_array($userRole, $arguments)) {
                return redirect()->to('/auth')->with('error', 'Akses ditolak');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}