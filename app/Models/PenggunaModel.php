<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'jabatan', 'izin_akses', 'foto'];
}
