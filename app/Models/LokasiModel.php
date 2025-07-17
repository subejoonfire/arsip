<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiModel extends Model
{
    protected $table = 'lokasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idarsip', 'idsuratkeluar', 'idsuratmasuk', 'nomor_rak'];

    /**
     * Ambil semua lokasi beserta detail arsip dan surat terkait
     */
    public function getLokasiWithDetails()
    {
        return $this->select('lokasi.*, arsip.nama_box, 
                         suratkeluar.nomor_surat as no_surat_keluar,
                         suratkeluar.perihal as perihal_keluar,
                         suratkeluar.lampiran as lampiran_keluar,
                         suratmasuk.no_surat as no_surat_masuk,
                         suratmasuk.file_lampiran as lampiran_masuk,
                         suratmasuk.perihal as perihal_masuk')
            ->join('arsip', 'arsip.id = lokasi.idarsip')
            ->join('suratkeluar', 'suratkeluar.id = lokasi.idsuratkeluar', 'left')
            ->join('suratmasuk', 'suratmasuk.id = lokasi.idsuratmasuk', 'left')
            ->orderBy('lokasi.id', 'DESC')
            ->findAll();
    }

    /**
     * Ambil surat yang belum memiliki lokasi
     */
    public function getAvailableSuratKeluar()
    {
        return $this->db->table('suratkeluar')
            ->select('suratkeluar.*')
            ->join('lokasi', 'lokasi.idsuratkeluar = suratkeluar.id', 'left')
            ->where('lokasi.idsuratkeluar IS NULL')
            ->get()
            ->getResultArray();
    }

    public function getAvailableSuratMasuk()
    {
        return $this->db->table('suratmasuk')
            ->select('suratmasuk.*')
            ->join('lokasi', 'lokasi.idsuratmasuk = suratmasuk.id', 'left')
            ->where('lokasi.idsuratmasuk IS NULL')
            ->get()
            ->getResultArray();
    }
}
