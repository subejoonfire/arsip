<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table = 'suratkeluar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nomor_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'lampiran'
    ];
}
