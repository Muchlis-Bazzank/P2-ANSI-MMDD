<?php

namespace App\Models;

use CodeIgniter\Model;

class KeahlianModel extends Model
{
    protected $table      = 'bidang_keahlian';
    protected $primaryKey = 'id';

    protected $allowedFields = ['dosen_id', 'nama_keahlian'];
}