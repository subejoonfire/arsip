<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SuratMasukModel;

class SuratMasuk extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SuratMasukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Surat Masuk',
            'suratMasuk' => $this->model->findAll()
        ];

        return view('admin/suratmasuk/index', $data);
    }

    public function tambah()
    {
        return view('admin/suratmasuk/tambah');
    }

    public function store()
    {
        $fileLampiran = $this->request->getFile('file_lampiran');
        $lampiranName = '';

        // Validasi file
        if ($fileLampiran && $fileLampiran->isValid() && !$fileLampiran->hasMoved()) {
            $lampiranName = $fileLampiran->getRandomName();
            $fileLampiran->move('uploads', $lampiranName);
        }

        // Simpan ke DB
        $this->model->insert([
            'no_surat'      => $this->request->getPost('no_surat'),
            'tgl_surat'     => $this->request->getPost('tgl_surat'),
            'pengirim'      => $this->request->getPost('pengirim'),
            'perihal'       => $this->request->getPost('perihal'),
            'file_lampiran' => $lampiranName
        ]);

        return redirect()->to('/admin/suratmasuk')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $surat = $this->model->find($id);

        if (!$surat) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Surat Masuk tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Surat Masuk',
            'surat' => $surat
        ];

        return view('admin/suratmasuk/edit', $data);
    }

    public function update($id)
    {
        $suratLama = $this->model->find($id);
        if (!$suratLama) {
            return redirect()->to('/admin/suratmasuk')->with('error', 'Data tidak ditemukan.');
        }

        $fileLampiran = $this->request->getFile('file_lampiran');
        $lampiranName = $suratLama['file_lampiran']; // Default: gunakan nama file lama

        // Jika ada file baru diupload
        if ($fileLampiran && $fileLampiran->isValid() && !$fileLampiran->hasMoved()) {
            // Hapus file lama jika ada
            if (!empty($suratLama['file_lampiran']) && file_exists(FCPATH . 'uploads/' . $suratLama['file_lampiran'])) {
                unlink(FCPATH . 'uploads/' . $suratLama['file_lampiran']);
            }
            $lampiranName = $fileLampiran->getRandomName();
            $fileLampiran->move('uploads', $lampiranName);
        }

        // Update ke DB
        $this->model->update($id, [
            'no_surat'      => $this->request->getPost('no_surat'),
            'tgl_surat'     => $this->request->getPost('tgl_surat'),
            'pengirim'      => $this->request->getPost('pengirim'),
            'perihal'       => $this->request->getPost('perihal'),
            'file_lampiran' => $lampiranName
        ]);

        return redirect()->to('/admin/suratmasuk')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        // Hapus file lampiran jika ada
        $surat = $this->model->find($id);
        if ($surat && !empty($surat['file_lampiran']) && file_exists(FCPATH . 'uploads/' . $surat['file_lampiran'])) {
            unlink(FCPATH . 'uploads/' . $surat['file_lampiran']);
        }

        // Hapus dari DB
        $this->model->delete($id);

        return redirect()->to('/admin/suratmasuk')->with('success', 'Data berhasil dihapus');
    }
}
