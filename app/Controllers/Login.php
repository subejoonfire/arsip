<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $model = new PenggunaModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();
        // Memeriksa apakah pengguna ditemukan dan password valid
        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'id' => $user['id'],
                'username' => $user['username'],
                'nama_lengkap' => $user['nama_lengkap'],
                'role' => $user['role'],
                'izin_akses' => $user['izin_akses'],
                'isLoggedIn' => true
            ]);
            if ($user['izin_akses'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/pegawai/dashboard');
            }
        } else {
            // Jika login gagal, set flashdata untuk menampilkan pesan error
            $session->setFlashdata('error', 'Username atau password salah.');
            return redirect()->to('/login');
        }
        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
