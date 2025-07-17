<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang di Dashboard Admin!</h2>

    <p class="text-gray-700 mb-8">Anda masuk sebagai <span
            class="font-semibold text-blue-600"><?= session('nama_lengkap') ?? 'Admin' ?></span>.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card Surat Masuk -->
        <a href="<?= base_url('admin/suratmasuk') ?>"
            class="block bg-blue-500 text-white p-6 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <i class="fas fa-inbox text-4xl opacity-75"></i>
                <h3 class="text-2xl font-semibold">Surat Masuk</h3>
            </div>
            <p class="mt-4 text-lg">Kelola semua surat masuk.</p>
        </a>

        <!-- Card Surat Keluar -->
        <a href="<?= base_url('admin/suratkeluar') ?>"
            class="block bg-green-500 text-white p-6 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <i class="fas fa-paper-plane text-4xl opacity-75"></i>
                <h3 class="text-2xl font-semibold">Surat Keluar</h3>
            </div>
            <p class="mt-4 text-lg">Kelola semua surat keluar.</p>
        </a>

        <!-- Card Pengaturan (Contoh) -->
        <!-- <a href="#"
            class="block bg-purple-500 text-white p-6 rounded-lg shadow-lg hover:bg-purple-600 transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <i class="fas fa-cog text-4xl opacity-75"></i>
                <h3 class="text-2xl font-semibold">Pengaturan</h3>
            </div>
            <p class="mt-4 text-lg">Konfigurasi sistem.</p>
        </a> -->
    </div>
</div>
<?= $this->endSection() ?>