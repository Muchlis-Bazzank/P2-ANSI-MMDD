<?php

namespace App\Models;

use CodeIgniter\Model;

class EvaluasiModel extends Model
{
    protected $table      = 'evaluasi_kinerja';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'dosen_id', 'semester', 'tahun_ajaran', 'skor', 'catatan', 'tanggal_evaluasi'
    ];
}