<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SuratKeluarModel;

class SuratKeluar extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SuratKeluarModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Surat Keluar',
            'suratkeluar' => $this->model->findAll()
        ];

        return view('admin/suratkeluar/index', $data);
    }

    public function tambah()
    {
        return view('admin/suratkeluar/tambah');
    }

    public function store()
    {
        $lampiran = $this->request->getFile('file_surat');
        $lampiranName = '';

        // ✅ Validasi file
        if ($lampiran && $lampiran->isValid() && !$lampiran->hasMoved()) {
            $lampiranName = $lampiran->getRandomName();
            $lampiran->move('uploads', $lampiranName);
        }

        // ✅ Simpan ke DB
        $this->model->insert([
            'nomor_surat' => $this->request->getPost('no_surat'),
            'tanggal_surat'  => $this->request->getPost('tanggal'),
            'tujuan'   => $this->request->getPost('tujuan'),
            'perihal'  => $this->request->getPost('perihal'),
            'lampiran' => $lampiranName
        ]);

        return redirect()->to('/admin/suratkeluar')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $surat = $this->model->find($id);

        if (!$surat) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat Keluar tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Surat Keluar',
            'surat' => $surat
        ];

        return view('admin/suratkeluar/edit', $data);
    }

    public function update($id)
    {
        $suratLama = $this->model->find($id);
        if (!$suratLama) {
            return redirect()->to('/admin/suratkeluar')->with('error', 'Data tidak ditemukan.');
        }

        $fileLampiran = $this->request->getFile('file_surat');
        $lampiranName = $suratLama['lampiran']; // Default: gunakan nama file lama

        // Jika ada file baru diupload
        if ($fileLampiran && $fileLampiran->isValid() && !$fileLampiran->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($suratLama['lampiran']) && file_exists(FCPATH . 'uploads/' . $suratLama['lampiran'])) {
                unlink(FCPATH . 'uploads/' . $suratLama['lampiran']);
            }
            $lampiranName = $fileLampiran->getRandomName();
            $fileLampiran->move('uploads', $lampiranName);
        }

        // Update ke DB
        $this->model->update($id, [
            'nomor_surat' => $this->request->getPost('no_surat'),
            'tanggal_surat'  => $this->request->getPost('tanggal'),
            'tujuan'   => $this->request->getPost('tujuan'),
            'perihal'  => $this->request->getPost('perihal'),
            'lampiran' => $lampiranName
        ]);

        return redirect()->to('/admin/suratkeluar')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        // ✅ Hapus file lampiran jika ada
        $surat = $this->model->find($id);
        if ($surat && !empty($surat['lampiran']) && file_exists(FCPATH . 'uploads/' . $surat['lampiran'])) {
            unlink(FCPATH . 'uploads/' . $surat['lampiran']);
        }

        // ✅ Hapus dari DB
        $this->model->delete($id);

        return redirect()->to('/admin/suratkeluar')->with('success', 'Data berhasil dihapus');
    }
}
