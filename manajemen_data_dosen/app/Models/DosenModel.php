<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table      = 'dosen';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id', 'nidn', 'nip', 'gelar', 'alamat', 'telepon', 'foto'
    ];

    protected $useTimestamps = false;
}