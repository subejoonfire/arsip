<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6"><?= esc($title ?? 'Tambah Surat Masuk') ?></h2>

    <form action="/admin/suratmasuk/store" method="post" enctype="multipart/form-data" class="space-y-5">
        <?= csrf_field() ?>

        <div>
            <label for="no_surat" class="block text-sm font-medium text-gray-700">No Surat</label>
            <input type="text" name="no_surat" id="no_surat"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                required>
        </div>

        <div>
            <label for="tgl_surat" class="block text-sm font-medium text-gray-700">Tanggal Surat</label>
            <input type="date" name="tgl_surat" id="tgl_surat"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                required>
        </div>

        <div>
            <label for="pengirim" class="block text-sm font-medium text-gray-700">Pengirim</label>
            <input type="text" name="pengirim" id="pengirim"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                required>
        </div>

        <div>
            <label for="perihal" class="block text-sm font-medium text-gray-700">Perihal</label>
            <input type="text" name="perihal" id="perihal"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                required>
        </div>

        <div>
            <label for="file_lampiran" class="block text-sm font-medium text-gray-700">Lampiran (PDF/Gambar)</label>
            <input type="file" name="file_lampiran" id="file_lampiran" accept=".pdf,.jpg,.jpeg,.png"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
            <p class="mt-1 text-xs text-gray-500">Ukuran file maksimal 2MB. Format: PDF, JPG, PNG.</p>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="/admin/suratmasuk"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-300">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Simpan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>