<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang di Dashboard Pegawai!</h2>

    <p class="text-gray-700 mb-8">Halo, <span
            class="font-semibold text-blue-600"><?= session('nama_lengkap') ?? 'Pegawai' ?></span>. Anda memiliki akses
        terbatas.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="<?= base_url('pegawai/lokasi') ?>"
            class="block bg-green-500 text-white p-6 rounded-lg shadow-lg hover:bg-green-600 transition duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <i class="fas fa-paper-plane text-4xl opacity-75"></i>
                <h3 class="text-2xl font-semibold">Lihat Lokasi</h3>
            </div>
            <p class="mt-4 text-lg">Akses daftar lokasi.</p>
        </a>
    </div>
</div>
<?= $this->endSection() ?>