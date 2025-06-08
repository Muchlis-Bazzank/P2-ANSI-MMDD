<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table      = 'jadwal_mengajar';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'dosen_id', 'mata_kuliah', 'hari', 'jam_mulai', 'jam_selesai', 'ruang'
    ];
}