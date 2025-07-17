<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table      = 'suratmasuk';  // <== penting!
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'no_surat',
        'tgl_surat',
        'pengirim',
        'perihal',
        'file_lampiran'
    ];
}
