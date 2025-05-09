<?php

namespace App\Models;
use CodeIgniter\Model;

class PendidikanModel extends Model
{
    protected $table      = 'pendidikan';
    protected $primaryKey = 'id_pendidikan';

    protected $allowedFields = [
        'id_dosen', 'jenjang', 'institusi', 
        'program_studi', 'tahun_lulus'
    ];
}
