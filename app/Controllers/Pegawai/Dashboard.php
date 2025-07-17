<?php

namespace App\Controllers\Pegawai;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('pegawai/dashboard');
    }
}
