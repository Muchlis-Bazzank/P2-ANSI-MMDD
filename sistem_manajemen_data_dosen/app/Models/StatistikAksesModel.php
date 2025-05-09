<?php

namespace App\Models;
use CodeIgniter\Model;

class StatistikAksesModel extends Model
{
    protected $table      = 'statistik_akses';
    protected $primaryKey = 'id_statistik';

    protected $allowedFields = [
        'id_user', 'jenis_akses', 'waktu_akses', 'ip_address'
    ];
}
