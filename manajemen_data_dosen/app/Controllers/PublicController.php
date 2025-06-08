<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseBuilder;

class PublicController extends BaseController
{
    public function index()
    {
        $db = db_connect();

        $builder = $db->table('dosen');
        $builder->select('dosen.*, users.nama');
        $builder->join('users', 'users.id = dosen.user_id');
        $query = $builder->get();

        $data['daftarDosen'] = $query->getResultArray();

        return view('public/dosen', $data);
    }
}