<?php

namespace App\Models;
use CodeIgniter\Model;

class PermintaanPerubahanModel extends Model
{
    protected $table      = 'permintaan_perubahan';
    protected $primaryKey = 'id_permintaan';

    protected $allowedFields = [
        'id_dosen', 'tipe_data', 'data_lama', 'data_baru',
        'status', 'tanggal_permohonan', 'tanggal_respon', 'id_admin_respon'
    ];
}
