<?php

namespace App\Models;
use CodeIgniter\Model;

class PublikasiModel extends Model
{
    protected $table      = 'publikasi';
    protected $primaryKey = 'id_publikasi';

    protected $allowedFields = [
        'id_dosen', 'judul', 'jenis', 'tahun', 'media', 'url'
    ];
}
