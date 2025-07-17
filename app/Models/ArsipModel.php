<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    protected $table = 'arsip';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_box'];

    /**
     * Ambil semua arsip termasuk jumlah surat yang tersimpan
     */
    public function getArsipWithCount()
    {
        return $this->select('arsip.*, COUNT(lokasi.id) as jumlah_surat')
            ->join('lokasi', 'lokasi.idarsip = arsip.id', 'left')
            ->groupBy('arsip.id')
            ->findAll();
    }

    /**
     * Cek apakah arsip memiliki lokasi terkait
     * 
     * @param int $idArsip ID arsip yang akan dicek
     * @return bool True jika memiliki lokasi, false jika tidak
     */
    public function hasLokasi($idArsip)
    {
        return $this->db->table('lokasi')
            ->where('idarsip', $idArsip)
            ->countAllResults() > 0;
    }
}
