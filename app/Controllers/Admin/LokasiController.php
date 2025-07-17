<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LokasiModel;
use App\Models\ArsipModel;
use App\Models\SuratKeluarModel;
use App\Models\SuratMasukModel;

class LokasiController extends BaseController
{
    protected $lokasiModel;
    protected $arsipModel;
    protected $suratKeluarModel;
    protected $suratMasukModel;

    public function __construct()
    {
        $this->lokasiModel = new LokasiModel();
        $this->arsipModel = new ArsipModel();
        $this->suratKeluarModel = new SuratKeluarModel();
        $this->suratMasukModel = new SuratMasukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Lokasi Arsip',
            'lokasi' => $this->lokasiModel->getLokasiWithDetails(), // Method baru di model
        ];
        return view('admin/lokasi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Lokasi Arsip',
            'arsip' => $this->arsipModel->findAll(),
            'suratKeluar' => $this->suratKeluarModel->findAll(),
            'suratMasuk' => $this->suratMasukModel->findAll()
        ];
        return view('admin/lokasi/tambah', $data);
    }

    public function store()
    {
        $rules = [
            'idarsip' => 'required',
            'nomor_rak' => 'required|numeric',
            'jenis_surat' => 'required|in_list[keluar,masuk]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'idarsip' => $this->request->getPost('idarsip'),
            'nomor_rak' => $this->request->getPost('nomor_rak')
        ];

        if ($this->request->getPost('jenis_surat') == 'keluar') {
            $data['idsuratkeluar'] = $this->request->getPost('idsuratkeluar');
            $data['idsuratmasuk'] = null;
        } else {
            $data['idsuratmasuk'] = $this->request->getPost('idsuratmasuk');
            $data['idsuratkeluar'] = null;
        }
        $this->lokasiModel->save($data);

        return redirect()->to('/admin/lokasi')->with('message', 'Lokasi arsip berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lokasi = $this->lokasiModel->find($id);
        if (!$lokasi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Lokasi Arsip',
            'lokasi' => $lokasi,
            'arsip' => $this->arsipModel->findAll(),
            'suratKeluar' => $this->suratKeluarModel->findAll(),
            'suratMasuk' => $this->suratMasukModel->findAll()
        ];

        return view('admin/lokasi/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'idarsip' => 'required',
            'nomor_rak' => 'required|numeric',
            'jenis_surat' => 'required|in_list[keluar,masuk]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id' => $id,
            'idarsip' => $this->request->getPost('idarsip'),
            'nomor_rak' => $this->request->getPost('nomor_rak')
        ];

        if ($this->request->getPost('jenis_surat') == 'keluar') {
            $data['idsuratkeluar'] = $this->request->getPost('idsuratkeluar');
            $data['idsuratmasuk'] = null;
        } else {
            $data['idsuratmasuk'] = $this->request->getPost('idsuratmasuk');
            $data['idsuratkeluar'] = null;
        }
        $this->lokasiModel->save($data);

        return redirect()->to('/admin/lokasi')->with('message', 'Lokasi arsip berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->lokasiModel->delete($id);
        return redirect()->to('/admin/lokasi')->with('message', 'Lokasi arsip berhasil dihapus');
    }
}
