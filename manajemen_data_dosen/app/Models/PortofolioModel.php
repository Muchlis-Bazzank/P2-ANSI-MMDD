<?php

namespace App\Models;

use CodeIgniter\Model;

class PortofolioModel extends Model
{
    protected $table = 'portofolio';
    protected $allowedFields = ['dosen_id', 'kategori', 'judul', 'deskripsi', 'tahun'];
    protected $useTimestamps = true;
}