<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Surat Keluar</h2>

    <form method="post" action="<?= base_url('admin/suratkeluar/update/' . esc($surat['id'])) ?>"
        enctype="multipart/form-data" class="space-y-5">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <!-- Penting untuk method spoofing -->

        <div>
            <label for="no_surat" class="block text-sm font-medium text-gray-700">No Surat</label>
            <input type="text" name="no_surat" id="no_surat"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                value="<?= esc($surat['nomor_surat']) ?>" required>
        </div>

        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" id="tanggal"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                value="<?= esc($surat['tanggal_surat']) ?>" required>
        </div>

        <div>
            <label for="tujuan" class="block text-sm font-medium text-gray-700">Tujuan</label>
            <input type="text" name="tujuan" id="tujuan"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                value="<?= esc($surat['tujuan']) ?>" required>
        </div>

        <div>
            <label for="perihal" class="block text-sm font-medium text-gray-700">Perihal</label>
            <input type="text" name="perihal" id="perihal"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                value="<?= esc($surat['perihal']) ?>">
        </div>

        <div>
            <label for="file_surat" class="block text-sm font-medium text-gray-700">Upload File (PDF/Gambar)</label>
            <?php if (!empty($surat['lampiran'])) : ?>
                <p class="text-sm text-gray-600 mb-2">File saat ini: <a
                        href="<?= base_url('uploads/' . esc($surat['lampiran'])) ?>" target="_blank"
                        class="text-blue-500 hover:underline"><?= esc($surat['lampiran']) ?></a></p>
            <?php endif; ?>
            <input type="file" name="file_surat" id="file_surat"
                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
            <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah file. Ukuran file maksimal 2MB.
                Format: PDF, JPG, PNG.</p>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('admin/suratkeluar') ?>"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-300">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Update</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>