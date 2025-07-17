<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Lokasi Arsip</h2>

    <form action="<?= base_url('admin/lokasi/update/' . $lokasi['id']) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="idarsip" class="block text-sm font-medium text-gray-700">Nama Box Arsip</label>
                <select name="idarsip" id="idarsip"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                    required>
                    <option value="">Pilih Box Arsip</option>
                    <?php foreach ($arsip as $item) : ?>
                    <option value="<?= $item['id'] ?>" <?= ($item['id'] == $lokasi['idarsip']) ? 'selected' : '' ?>>
                        <?= esc($item['nama_box']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="nomor_rak" class="block text-sm font-medium text-gray-700">Nomor Rak</label>
                <input type="number" name="nomor_rak" id="nomor_rak"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border"
                    value="<?= esc($lokasi['nomor_rak']) ?>" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Jenis Surat</label>
            <div class="mt-1 space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_surat" value="keluar" class="form-radio"
                        <?= ($lokasi['idsuratkeluar']) ? 'checked' : '' ?> onchange="toggleSuratSection('keluar')">
                    <span class="ml-2">Surat Keluar</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="jenis_surat" value="masuk" class="form-radio"
                        <?= ($lokasi['idsuratmasuk']) ? 'checked' : '' ?> onchange="toggleSuratSection('masuk')">
                    <span class="ml-2">Surat Masuk</span>
                </label>
            </div>
        </div>

        <div id="surat-keluar-section" class="mb-4" style="display:<?= $lokasi['idsuratkeluar'] ? 'block' : 'none' ?>;">
            <label for="idsuratkeluar" class="block text-sm font-medium text-gray-700">Surat Keluar</label>
            <select name="idsuratkeluar" id="idsuratkeluar"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
                <option value="">Pilih Surat Keluar</option>
                <?php foreach ($suratKeluar as $surat) : ?>
                <option value="<?= $surat['id'] ?>" <?= ($surat['id'] == $lokasi['idsuratkeluar']) ? 'selected' : '' ?>>
                    <?= esc($surat['nomor_surat'] . ' - ' . $surat['perihal']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="surat-masuk-section" class="mb-4" style="display:<?= $lokasi['idsuratmasuk'] ? 'block' : 'none' ?>;">
            <label for="idsuratmasuk" class="block text-sm font-medium text-gray-700">Surat Masuk</label>
            <select name="idsuratmasuk" id="idsuratmasuk"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2 border">
                <option value="">Pilih Surat Masuk</option>
                <?php foreach ($suratMasuk as $surat) : ?>
                <option value="<?= $surat['id'] ?>" <?= ($surat['id'] == $lokasi['idsuratmasuk']) ? 'selected' : '' ?>>
                    <?= esc($surat['no_surat'] . ' - ' . $surat['perihal']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="flex justify-end space-x-3">
            <a href="<?= base_url('admin/lokasi') ?>"
                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-300">Batal</a>
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Update</button>
        </div>
    </form>
</div>

<script>
function toggleSuratSection(type) {
    const suratKeluarSection = document.getElementById('surat-keluar-section');
    const suratMasukSection = document.getElementById('surat-masuk-section');

    if (type === 'keluar') {
        suratKeluarSection.style.display = 'block';
        suratMasukSection.style.display = 'none';
        document.getElementById('idsuratmasuk').value = '';
    } else {
        suratKeluarSection.style.display = 'none';
        suratMasukSection.style.display = 'block';
        document.getElementById('idsuratkeluar').value = '';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($lokasi['idsuratkeluar']) : ?>
    toggleSuratSection('keluar');
    <?php elseif ($lokasi['idsuratmasuk']) : ?>
    toggleSuratSection('masuk');
    <?php endif; ?>
});
</script>
<?= $this->endSection() ?>