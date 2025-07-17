<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Jika belum login, redirect ke halaman login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika ada argumen (role yang diizinkan)
        if ($arguments) {
            $izinAkses = $session->get('izin_akses'); // Ambil izin_akses dari session
            if (!in_array($izinAkses, $arguments)) {
                // Jika role tidak diizinkan, redirect ke dashboard sesuai role atau halaman error
                if ($izinAkses === 'admin') {
                    return redirect()->to(base_url('admin/dashboard'))->with('error', 'Akses ditolak.');
                } elseif ($izinAkses === 'pegawai') {
                    return redirect()->to(base_url('pegawai/dashboard'))->with('error', 'Akses ditolak.');
                } else {
                    return redirect()->to(base_url('login'))->with('error', 'Akses tidak sah.');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
