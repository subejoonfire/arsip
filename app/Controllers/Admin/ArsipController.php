<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class ArsipController extends BaseController
{
    protected $arsipModel;

    public function __construct()
    {
        $this->arsipModel = new ArsipModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen Arsip',
            'arsip' => $this->arsipModel->getArsipWithCount()
        ];

        return view('admin/arsip/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Arsip Baru'
        ];

        return view('admin/arsip/tambah', $data);
    }

    public function store()
    {
        $rules = [
            'nama_box' => 'required|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->arsipModel->save([
            'nama_box' => $this->request->getPost('nama_box')
        ]);

        return redirect()->to('/admin/arsip')->with('message', 'Arsip baru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Arsip',
            'arsip' => $this->arsipModel->find($id)
        ];

        return view('admin/arsip/edit', $data);
    }

    public function update($id)
    {
        $rules = [
            'nama_box' => 'required|max_length[255]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->arsipModel->save([
            'id' => $id,
            'nama_box' => $this->request->getPost('nama_box')
        ]);

        return redirect()->to('/admin/arsip')->with('message', 'Arsip berhasil diperbarui');
    }

    public function delete($id)
    {
        if ($this->arsipModel->hasLokasi($id)) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus arsip yang memiliki lokasi surat');
        }

        $this->arsipModel->delete($id);
        return redirect()->to('/admin/arsip')->with('message', 'Arsip berhasil dihapus');
    }
}