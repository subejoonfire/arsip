<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tb_pengguna';
    protected $primaryKey = 'id_pg';
    protected $allowedFields = ['username', 'password', 'nama_lengkap', 'jabatan', 'izin_akses', 'foto'];
}