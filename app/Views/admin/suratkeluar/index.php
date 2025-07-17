<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Surat Keluar</h2>

    <div class="flex justify-between items-center mb-4">
        <a href="<?= base_url('admin/suratkeluar/tambah') ?>"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition duration-300">
            <i class="fas fa-plus-circle mr-1"></i> Tambah Surat Keluar
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline"><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">No Surat</th>
                    <th class="py-3 px-6 text-left">Tanggal</th>
                    <th class="py-3 px-6 text-left">Tujuan</th>
                    <th class="py-3 px-6 text-left">Perihal</th>
                    <th class="py-3 px-6 text-left">Lampiran</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                <?php $no = 1;
                foreach ($suratkeluar as $surat) : ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= $no++ ?></td>
                        <td class="py-3 px-6 text-left"><?= esc($surat['nomor_surat']) ?></td>
                        <td class="py-3 px-6 text-left"><?= esc($surat['tanggal_surat']) ?></td>
                        <td class="py-3 px-6 text-left"><?= esc($surat['tujuan']) ?></td>
                        <td class="py-3 px-6 text-left"><?= esc($surat['perihal']) ?></td>
                        <td class="py-3 px-6 text-left">
                            <?php if (!empty($surat['lampiran'])) : ?>
                                <a href="<?= base_url('uploads/' . $surat['lampiran']) ?>" target="_blank"
                                    class="text-blue-500 hover:underline">Lihat</a>
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="<?= base_url('admin/suratkeluar/edit/' . $surat['id']) ?>"
                                    class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= base_url('admin/suratkeluar/delete/' . $surat['id']) ?>"
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="w-4 mr-2 transform hover:text-red-500 hover:scale-110 text-red-600">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>