<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Arsip</h2>

    <form action="<?= base_url('admin/arsip/store') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label for="nama_box" class="block text-sm font-medium text-gray-700">Nama Box</label>
            <input type="text" name="nama_box" id="nama_box"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                required>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('admin/arsip') ?>"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-300">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>