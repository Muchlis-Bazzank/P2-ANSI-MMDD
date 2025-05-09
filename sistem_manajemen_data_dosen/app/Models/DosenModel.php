<?php

namespace App\Models;
use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 'dosen';
    protected $primaryKey = 'id_dosen';

    protected $allowedFields = [
        'id_user', 'nama_lengkap', 'nidn', 'gelar_depan',
        'gelar_belakang', 'jenis_kelamin', 'tanggal_lahir',
        'alamat', 'no_hp', 'email_kampus', 'foto_profil'
    ];
}
